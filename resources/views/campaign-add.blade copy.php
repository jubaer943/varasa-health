<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require_once '../assets/php/common_class.php';
require_once 'includes/funtions.php';

$obj = new DatabaseQuery();

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $rawData = file_get_contents('php://input');
    $inputData = json_decode($rawData, true);
    $correctQuestionCount = 0;
    $response = [];
    $allQuestions = []; // Declare it outside the loop to accumulate all questions
    $skippedQuestionCount = 0;
    foreach ($inputData['questions'] as $question) {
        $questionId = $question['id'];
        $type = $question['type'];
        $userId = $question['userId'];

        // Check if any answers were selected for the question
        if (empty($question['answers']) || in_array(0, array_column($question['answers'], 'id'))) {
            // Mark question as skipped
            // Increment skipped question count
            $skippedQuestionCount++;
            $response[] = [
                'question_id' => $questionId,
                'status' => 0,
                'is_correct' => 0
            ];

            // Fetch question details
            $selectedQuestions = $obj->getData('mcqquestions', '*', ['id' => $questionId]);
            if ($selectedQuestions) {
                foreach ($selectedQuestions as $selectedQuestion) {
                    $questionData = [
                        'id' => (int) $selectedQuestion['id'],
                        'question' => $selectedQuestion['Question'],
                        'audio' => $selectedQuestion['audio'],
                        'image' => $selectedQuestion['image'],
                        'answers' => [], // Initialize answers array
                        'selected_answers' => [] // No answers selected for skipped questions
                    ];

                    // Fetch possible answers for the question
                    $selectedAnswers = $obj->getData('mcqanswe', '*', ['question_id' => $selectedQuestion['id']]);
                    if (!empty($selectedAnswers)) {
                        foreach ($selectedAnswers as $selectedAnswer) {
                            $questionData['answers'][] = [
                                'id' => (int) $selectedAnswer['id'],
                                'Answer' => $selectedAnswer['Answer'],
                                'is_correct' => (int) $selectedAnswer['is_correct'],
                            ];
                        }
                    }

                    // Add question data to the allQuestions array
                    $allQuestions[] = $questionData;
                }
            }

            continue;
        }

        // Get correct answers for this question
        $correctAnswers = null;
        if ($type == "mcq" || $type == 1) {
            $correctAnswers = $obj->getData('mcqanswe', '*', ['question_id' => $questionId, 'is_correct' => 1]);
            $selectedQuestions = $obj->getData('mcqquestions', '*', ['id' => $questionId]);
        } elseif ($type == "paragraph" || $type == 2) {
            $correctAnswers = $obj->getData('parabasedans', '*', ['question_id' => $questionId, 'is_correct' => 1]);
            $selectedQuestions = $obj->getData('parabasedmsq', '*', ['id' => $questionId]);
        } elseif ($type == "free") {
            $correctAnswers = $obj->getData('freemocktestans', '*', ['question_id' => $questionId, 'is_correct' => 1]);
            $selectedQuestions = $obj->getData('freemocktest', '*', ['id' => $questionId]);
        } elseif ($type == "fillinthegap" || $type == 3) {
            // Fetch all options for the question
            $options = $obj->getData('pragraphoptions', '*', ['qustionId' => $questionId]);
            $selectedQuestions = $obj->getData('pragraphmcq', '*', ['id' => $questionId]);

            if (!empty($selectedQuestions)) {
                foreach ($selectedQuestions as $selectedQuestion) {
                    $questionData = [
                        'id' => (int) $selectedQuestion['id'],
                        'question' => $selectedQuestion['Question'],
                        'fill_blank' => [],
                        'selected_answers' => []
                    ];

                    // Process options and their answers
                    if (!empty($options)) {
                        foreach ($options as $option) {
                            $optionKey = $option['paraOption'];
                            $answers = $obj->getData('optionsanswer', '*', ['optionId' => $option['id']]);

                            // Add all possible answers for the option
                            if (!empty($answers)) {
                                foreach ($answers as $answer) {
                                    $questionData['fill_blank'][$optionKey][] = [
                                        'id' => (int) $answer['id'],
                                        'answer' => $answer['answer'],
                                        'is_correct' => (int) $answer['is_correct']
                                    ];
                                }
                            }
                        }
                    }

                    // Add selected answers for the question
                    foreach ($question['answers'] as $selectedAnswer) {
                        $questionData['selected_answers'][] = [
                            'id' => (int) $selectedAnswer['id']
                        ];
                    }

                    // Validate selected answers against correct answers
                    $correctAnswers = [];
                    foreach ($options as $option) {
                        $correctAnswersForOption = $obj->getData('optionsanswer', '*', [
                            'optionId' => $option['id'],
                            'is_correct' => 1
                        ]);

                        if (!empty($correctAnswersForOption)) {
                            $correctAnswers = array_merge($correctAnswers, $correctAnswersForOption);
                        }
                    }

                    // Count how many selected answers match correct answers
                    $correctAnswersCount = 0;
                    foreach ($question['answers'] as $answer) {
                        foreach ($correctAnswers as $correctAnswer) {
                            if ($answer['id'] == $correctAnswer['id']) {
                                $correctAnswersCount++;
                            }
                        }
                    }

                    // Check if the question is fully correct
                    if ($correctAnswersCount === count($correctAnswers)) {
                        $correctQuestionCount++;
                    }

                    // Add the question to the response
                    $allQuestions[] = $questionData;
                }
            }

            continue;
        }



        // $obj->print_arr($correctAnswers);
        // exit;
        $correctAnswersCount = 0;
        $is_correct = 0;
        foreach ($question['answers'] as $answer) {
            $answerId = $answer['id'];

            // Compare the user's selected answer with correct answers
            foreach ($correctAnswers as $correctAnswer) {
                if ($answerId == $correctAnswer['id']) {
                    $correctAnswersCount++;
                }
            }
        }

        // If all selected answers are correct, increment the counter
        if ($correctAnswersCount === count($correctAnswers)) {
            $correctQuestionCount++;
            $is_correct = 1;
        }

        // echo json_encode($selectedQuestions);

        if ($selectedQuestions) {
            foreach ($selectedQuestions as $selectedQuestion) {
                // $keyForQuestion = $type == "mcq" || 1 ? "Question" : "question";
                if ($type == 1 || $type == 2 || $type == 3) {
                    if ($type == 1) {
                        $keyForQuestion = 'Question';
                    } elseif ($type == 2) {
                        $keyForQuestion = 'question';
                    }
                } else {
                    $keyForQuestion = $type == "mcq" ? "Question" : "question";
                }
                $questionData = [
                    'id' => (int) $selectedQuestion['id'],
                    'question' => $selectedQuestion[$keyForQuestion],
                    'audio' => $selectedQuestion['audio'],
                    'image' => $selectedQuestion['image'],
                    'answers' => [], // Initialize as an empty array
                    'selected_answers' => []
                ];

                // Fetch answers for the current question
                if ($type == "mcq" || $type == 1) {
                    $selectedAnswers = $obj->getData('mcqanswe', '*', ['question_id' => $selectedQuestion['id']]);
                } elseif ($type == "paragraph" || $type == 2) {
                    $selectedAnswers = $obj->getData('parabasedans', '*', ['question_id' => $selectedQuestion['id']]);
                } elseif ($type = "free") {
                    $selectedAnswers = $obj->getData('freemocktestans', '*', ['question_id' => $selectedQuestion['id']]);
                }

                if (!empty($selectedAnswers)) {
                    foreach ($selectedAnswers as $selectedAnswer) {
                        $questionData['answers'][] = [ // Append to 'answers'
                            'id' => (int) $selectedAnswer['id'],
                            'Answer' => $selectedAnswer['Answer'],
                            'is_correct' => (int) $selectedAnswer['is_correct'],
                        ];
                    }
                }
                // Add selected answer IDs for the question
                foreach ($question['answers'] as $selectedAnswer) {
                    $questionData['selected_answers'][] = [
                        'id' => (int) $selectedAnswer['id']
                    ];
                }
                // Add the current question data to the allQuestions array
                $allQuestions[] = $questionData;
                if ($type == 1 || $type == 2 || $type == 3) {
                    if ($type == 1) {
                        $couserIdKey = 'Categoryname';
                    } elseif ($type == 2) {
                        $couserIdKey = 'categoryName';
                    }
                } else {
                    $couserIdKey = $type == "mcq" ? "Categoryname" : "categoryName";
                }

                $selected_answer  = json_encode($questionData['selected_answers']);
                $response[] = [
                    'courseId' => $selectedQuestion[$couserIdKey],
                    'chapterName' => $selectedQuestion['chapterName'],
                    'question_id' => $selectedQuestion['id'],
                    'selected_answers' => $selected_answer,
                    'userId' => $userId,
                    'type' => $type,
                ];
            }
        }
    }
    // echo json_encode($inputData);
    // exit;
    foreach ($response as $res) {
        $obj->insertData('result', array(
            'courseId' => $res['courseId'] ?? null,
            'chapterName' => $res['chapterName'] ?? null,
            'question_id' => $res['question_id'] ?? null,
            'selected_answers' => $res['selected_answers'] ?? null,
            'userId' => $userId,
            'type' => $res['type'] ?? null,
        ));
    }
    if ($type == 1 || $type == 2 || $type == 3) {
        $question_type = "mockTest";
        $resultID =  $obj->insertData(
            'allresult',
            array(
                'userId' => $userId,
                'questionType' => 'mockTest',
                'tatal_question' => count($allQuestions) + $skippedQuestionCount,
                'scrore' => $correctQuestionCount,
                'skip' => $skippedQuestionCount,
                'answers' => json_encode($inputData),
            )
        );
    } else {
        $question_type = $type;
        $resultID = $obj->insertData(
            'allresult',
            array(
                'userId' => $userId,
                'questionType' => $type,
                'tatal_question' => count($allQuestions) + $skippedQuestionCount,
                'scrore' => $correctQuestionCount,
                'skip' => $skippedQuestionCount,
                'answers' => json_encode($inputData),
            )
        );
    }

    // Calculate percentage
    $totalQuestions = count($allQuestions) + $skippedQuestionCount;
    $score = $correctQuestionCount;

    $percentage = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

    // Determine performance based on percentage
    if ($percentage <= 30) {
        $performance = "Poor";
    } elseif ($percentage <= 50) {
        $performance = "Good";
    } elseif ($percentage <= 70) {
        $performance = "Average";
    } elseif ($percentage <= 80) {
        $performance = "Excellent";
    } else {
        $performance = "Excellent & Surprise";
    }
    // Return the result including skipped questions and correct answers count
    $jsonOutput = json_encode([
        'status' => 1,
        'code' => 200,
        'message' => 'Data  retrieved successfully',
        'correct_question_count' => $correctQuestionCount,
        'result_id' => $resultID,
        'perfromance' => $performance,
        'type' => $question_type,
    ], JSON_INVALID_UTF8_IGNORE);
    if ($jsonOutput === false) {
        echo json_encode(['error' => 'JSON encoding failed', 'details' => json_last_error_msg()]);
    } else {
        echo $jsonOutput;
    }
}
