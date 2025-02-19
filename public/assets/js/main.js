// ***** preloader and refresh start *****
const preloader = document.getElementById("preloader");
if (preloader) {
    window.addEventListener("load", () => {
        preloader.style.display = "none";
    });
}

const Refresh = document.querySelector(".Refresh");
if (Refresh) {
    Refresh.addEventListener("click", () => {
        window.location.reload();
    });
}
// ***** preloader and refresh end *****

// input box design
const presentation_label = document.querySelectorAll(".presentation-label");
if (presentation_label) {
    presentation_label.forEach((elem) => {
        let check_type = "green";
        elem.innerHTML = `<img class="admin-check-mark" src="assets/images/check mark green.png" alt="check mark">`;

        elem.addEventListener("click", () => {
            if (check_type == "green") {
                elem.innerHTML = `<img class="admin-check-mark" src="assets/images/check mark white.png" alt="check mark">`;
                check_type = "white";
            } else {
                elem.innerHTML = `<img class="admin-check-mark" src="assets/images/check mark green.png" alt="check mark">`;
                check_type = "green";
            }
        });
    });
}

// navbar section start
const nav_link = document.querySelectorAll(".nav-link");
const nav_img = document.querySelectorAll(".nav-img");
let urls = false;
if (nav_link.length > 0) {
    nav_link.forEach((element) => {
        let path = window.location.pathname;

        // Split the path into segments
        const pathSegments = path.split("/").filter(Boolean);

        // Get the base path (e.g., /sub-admin)
        const basePath = `/${pathSegments[0]}`; // This will give /sub-admin

        // If there are additional segments, we extract only the base path and ignore extra segments
        const relevantPath = basePath;

        // Ensure element.pathname exists before using startsWith
        let elemPath = element.pathname || ''; // Default to an empty string if undefined
        if (!elemPath.startsWith("/")) {
            elemPath = `/${elemPath}`; // Ensure it's treated as a full path
        }
        let elemSegments = null;
        if (pathSegments.length > 1) {
            urls = true;
        } else {
            urls = false;
        }
        if (urls) {
            elemSegments = elemPath.split("/").filter(Boolean).slice(1);
        } else {
            elemSegments = elemPath.split("/").filter(Boolean);
        }
        console.log(elemSegments);


        // Compare the base path with the element's path
        const isMatch = relevantPath.toLocaleLowerCase() === `/${elemSegments[0]?.toLocaleLowerCase()}`;

        if (isMatch) {
            element.classList.add("active-nav-link");

            nav_img.forEach((img) => {
                if (element.innerText === img.alt) {
                    const imageUrl = img.getAttribute('data-image-url'); // Get the base URL from the data-attribute
                    img.src = `${imageUrl}/${element.innerText} black.png`; // Append the image filename dynamically
                }
            });
        }
    });
}




// navbar section end

// authentication start
const password_hide = document.querySelector(".fa-eye-slash");
const Password = document.getElementById("Password");

if (password_hide) {
    password_hide.addEventListener("click", () => {
        if (Password.type == "password") {
            Password.type = "text";
            password_hide.classList.replace("fa-eye-slash", "fa-eye");
        } else if (Password.type == "text") {
            Password.type = "password";
            password_hide.classList.replace("fa-eye", "fa-eye-slash");
        }
    });
}

const CnfmPassword = document.querySelector(".CnfmPassword");
const password_hides = document.querySelector(".CnfmPassSlash");
if (CnfmPassword) {
    password_hides.addEventListener("click", () => {
        if (CnfmPassword.type == "password") {
            CnfmPassword.type = "text";
            password_hides.classList.replace("fa-eye-slash", "fa-eye");
        } else if (CnfmPassword.type == "text") {
            CnfmPassword.type = "password";
            password_hides.classList.replace("fa-eye", "fa-eye-slash");
        }
    });
}
// authentication end

// order details start
const user_info_btn = document.querySelector(".user_info_btn");
const Prof_info_btn = document.querySelector(".Prof_info_btn");
const user_info = document.querySelector(".user-info");
const Professional_info = document.querySelector(".Professional-info");
if (user_info_btn) {
    user_info_btn.addEventListener("click", () => {
        user_info.classList.remove("user-hide");
        Professional_info.classList.add("user-hide");
        user_info_btn.classList.add("active-user-btn");
        Prof_info_btn.classList.remove("active-user-btn");
    });
    Prof_info_btn.addEventListener("click", () => {
        Professional_info.classList.remove("user-hide");
        user_info.classList.add("user-hide");
        Prof_info_btn.classList.add("active-user-btn");
        user_info_btn.classList.remove("active-user-btn");
    });
}

const download_type = document.querySelector(".download-type");
const user_download_type = document.querySelector(".user-download-type");
if (download_type) {
    download_type.addEventListener("click", () => {
        user_download_type.classList.toggle("hide-download-type");
    });
}
// order details end

// dashboard start
const year_left = document.querySelector(".year_left");
const year_right = document.querySelector(".year_right");
const dashboard_year = document.querySelector(".dashboard_year");
if (dashboard_year) {
    let year = 2024;

    year_left.addEventListener("click", () => {
        year -= 1;
        dashboard_year.innerHTML = year;
    });
    year_right.addEventListener("click", () => {
        year += 1;
        dashboard_year.innerHTML = year;
    });
}
// dashboard end

// ***** all common classes  *****
function AddClassFunc(ElemSelector1, ElemSelector2, ClassToggle, operation) {
    const element1 = document.querySelector(ElemSelector1);
    const element2 = document.querySelector(ElemSelector2);

    if (element1 && element2) {
        element1.addEventListener("click", () => {
            if (operation == "add") {
                element2.classList.add(ClassToggle);
            } else if (operation == "remove") {
                element2.classList.remove(ClassToggle);
            } else {
                console.log("Invalid operation");
            }
        });
    } else {
        console.log("Class is not found");
    }
}

// bar button
AddClassFunc(".bar_btn", ".responsive-navbar", "active_section", "add");
AddClassFunc(".Cross-Mark", ".responsive-navbar", "active_section", "remove");

// nurse service success
AddClassFunc(
    ".sub_nurse_submit",
    ".nurse-service-success",
    "active_section",
    "add"
);
AddClassFunc(
    ".success-close1",
    ".nurse-service-success",
    "active_section",
    "remove"
);
AddClassFunc(
    ".success-close2",
    ".nurse-service-success",
    "active_section",
    "remove"
);
// ***** all common classes  *****

// ***** file upload end *****
function UploadFunc(ElemSelector1, ElemSelector2) {
    const element1 = document.querySelector(ElemSelector1);
    const element2 = document.querySelector(ElemSelector2);

    if (element1 && element2) {
        element1.addEventListener("click", (e) => {
            e.preventDefault();
            element2.click();
        });
    }
}
UploadFunc(".upload-btn1", ".file1");
UploadFunc(".upload-btn2", ".file2");
UploadFunc(".upload-btn3", ".file3");
// ***** file upload end *****

// ***** toggle function start *****
function ToggleFunc(ElemSelector1, ElemSelector2, operation) {
    const element1 = document.querySelector(ElemSelector1);
    const element2 = document.querySelector(ElemSelector2);

    if (element1 && element2) {
        if (operation == "d_flex") {
            element1.addEventListener("click", () => {
                element2.classList.toggle("active_NurseCaregiver");
            });
        } else {
            element1.addEventListener("click", () => {
                element2.classList.toggle("active-notification");
            });
        }
    }
}
ToggleFunc(".notification", ".notification-box");
ToggleFunc(".NurseCaregiver", ".service-fee-details", "d_flex");

const NurseCaregiver_switch = document.querySelector(".NurseCaregiver-switchs");
const NurseCaregiver = document.querySelector(".NurseCaregiver-service");
if (NurseCaregiver_switch) {
    NurseCaregiver_switch.addEventListener("click", () => {
        NurseCaregiver.classList.toggle("disabled-service");
    });
}
// ***** toggle function end *****

// *********** our service section start ***********
const activities_btn = document.querySelector(".activities_btn");
const activities = document.querySelector(".activities");
const input_area = document.querySelectorAll(".input-area");

// add activities section start
function AddActivities() {
    const Activities_inp = document.querySelector(".activities-input").value;

    const newItem = document.createElement("div");
    newItem.classList.add("item");

    newItem.innerHTML = `
        <input type="text" name="Activities[]" class="activities-write" value="${Activities_inp}"  />
        <div class="activities-btns">
            <button type="button" class="edit-btn" onclick="editItem(this)">Edit</button>
            <button type="button" class="delete-btn" onclick="deleteItem(this)">Delete</button>
        </div>
    `;

    if (Activities_inp == "") {
        alert("Please! Write some activities");
    } else {
        activities.appendChild(newItem);
        document.querySelector(".activities-input").value = "";
    }
}
if (activities_btn) {
    activities_btn.addEventListener("click", () => {
        AddActivities();

        input_area.forEach((elem) => {
            elem.classList.add("active_input_area");
        });
    });
}
function editItem(button) {
    const activities_write = document.querySelectorAll(".activities-write");

    activities_write.forEach((elem) => {
        if (elem.disabled) {
            elem.disabled = false;
            button.textContent = "Save";
        } else {
            elem.disabled = true;
            button.textContent = "Edit";
        }
    });
}
function deleteItem() {
    const activities_btns = document.querySelector(".activities-btns");
    const item = activities_btns.parentElement;
    activities.removeChild(item);
}
// add activities section end

// add FAQ section start
const FAQ_btn = document.querySelector(".FAQ_btn");
const faq = document.querySelector(".faq");

function AddFAQ() {
    const FAQ_input = document.querySelector(".FAQ_input").value;
    const Answer_input = document.querySelector(".Answer_input").value;

    const newItem = document.createElement("div");
    newItem.classList.add("item");

    newItem.innerHTML = `
        <input type="text" name="FAQ[question][]" class="faq-question" value="${FAQ_input}"  />
        <input type="text" name="FAQ[answer][]" class="faq-answer" value="${Answer_input}" />
        <div class="faq-btns">
            <button type="button" class="edit-btn" onclick="editFAQ(this)">Edit</button>
            <button type="button" class="delete-btn" onclick="deleteFAQ(this)">Delete</button>
        </div>
    `;

    if (FAQ_input == "" && Answer_input == "") {
        alert("Please! Write some activities");
    } else {
        faq.appendChild(newItem);
        document.querySelector(".FAQ_input").value = "";
        document.querySelector(".Answer_input").value = "";
    }
}

if (FAQ_btn) {
    FAQ_btn.addEventListener("click", () => {
        AddFAQ();
    });
}

function editFAQ(button) {
    const faq_question = document.querySelector(".faq-question");
    const faq_answer = document.querySelector(".faq-answer");

    if (faq_question.disabled && faq_answer.disabled) {
        faq_question.disabled = false;
        faq_answer.disabled = false;
        button.textContent = "Save";
    } else {
        faq_question.disabled = true;
        faq_answer.disabled = true;
        button.textContent = "Edit";
    }
}
function deleteFAQ() {
    const faq_btns = document.querySelector(".faq-btns");
    const item = faq_btns.parentElement;
    faq.removeChild(item);
}
// add FAQ section end
// *********** our service section end ***********

// tab buttons
function AddClassFunction(
    ElemSelector1,
    ElemSelector2,
    btnClass,
    ContentClass
) {
    const element1 = document.querySelectorAll(ElemSelector1);
    const element2 = document.querySelectorAll(ElemSelector2);

    if (element1 && element2) {
        element1.forEach((btns, index) => {
            btns.addEventListener("click", () => {
                // class remove
                element2.forEach((content) => {
                    content.classList.remove(ContentClass);
                });
                element1.forEach((btn) => {
                    btn.classList.remove(btnClass);
                    const img = btn.querySelector("img");
                    if (img) {
                        img.src = "assets/images/arrow-right-green.png";
                    } else {
                        console.log("Image is not found");
                    }
                });
                // class remove

                // class add
                element1[index].classList.add(btnClass);
                element2[index].classList.add(ContentClass);
                const img = btns.querySelector("img");
                if (img) {
                    img.src = "assets/images/arrow-right-white.png";
                } else {
                    console.log("Image is not found");
                }
                // class add
            });
        });
    } else {
        console.log("Class is not found");
    }
}

AddClassFunction(".buttons", ".contents", "active-btn", "active_section");
AddClassFunction(
    ".user-pro-btn1",
    ".user-pro-contents1",
    "active-user-pro-btn",
    "active-user-pro-contents"
);
AddClassFunction(
    ".user-pro-btn2",
    ".user-pro-contents2",
    "active-user-pro-btn",
    "active-user-pro-contents"
);

// setting page contact section
const contact_edit = document.querySelector(".contact-edit");
const contact_input = document.querySelector(".contact-input");
const save = document.querySelector(".contact-save");
if (contact_edit) {
    contact_input.classList.add("input-opacity");
    save.classList.add("save-opacity");
    contact_edit.addEventListener("click", () => {
        if (contact_input.disabled) {
            contact_input.disabled = false;
            save.disabled = false;
            contact_input.classList.remove("input-opacity");
            save.classList.remove("save-opacity");
        } else {
            contact_input.disabled = true;
            save.disabled = true;
            contact_input.classList.add("input-opacity");
            save.classList.add("save-opacity");
        }
    });
}

// model show or hide
function AddModel(element1, element2) {
    const active = document.querySelector(element1);
    const success = document.querySelector(element2);

    if (active) {
        active.classList.add("active_model");
        active.addEventListener("click", () => {
            success.classList.add("active_model");
        });
    }
}
AddModel(".logoutBtn", ".logout-success");
AddModel(".logout", ".logout-success");
AddModel(".sub_nurse_submit", ".nurse-service");

function HideModel(element1, element2) {
    const cancel = document.querySelectorAll(element1);
    const success = document.querySelector(element2);

    if (cancel) {
        cancel.forEach((btn) => {
            btn.addEventListener("click", () => {
                success.classList.remove("active_model");
            });
        });
    }
}
HideModel(".cancel-logout", ".logout-success");
HideModel(".close", ".nurse-service");
