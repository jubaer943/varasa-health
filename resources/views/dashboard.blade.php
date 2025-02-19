@extends('master')

@section('content')
    @include('nav')
    <!-- page section start -->
    <div class="page-body order">
        <div class="dashboard-top">
            <div>
                <p>Active Orders</p>
                <p>0</p>
            </div>
            <div class="pending-order">
                <p>Pending Orders</p>
                <p>0</p>
            </div>
            <div>
                <p>Complete Orders</p>
                <p>0</p>
            </div>
            <div>
                <p>Our Services</p>
                <p>0</p>
            </div>
            <div>
                <p>Users</p>
                <p>0</p>
            </div>
            <div>
                <p>Professionals</p>
                <p>0</p>
            </div>
        </div>
        <div class="dashboard">
            <div class="card">
                <div class="title">
                    <p>Revenue</p>
                    <div>
                        <div>
                            <img class="year_left" src="assets/images/arrow-left.png" alt="varasa arrow icon">
                            <p class="dashboard_year">2024</p>
                            <img class="year_right" src="assets/images/arrow-right.png" alt="varasa arrow icon">
                        </div>
                        <select name="time" id="time">
                            <option value="monthly">Monthly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="chart">
                    <div>
                        <div class="bar bar6"></div>
                        <div class="label">Jan</div>
                    </div>
                    <div>
                        <div class="bar bar4"></div>
                        <div class="label">Feb</div>
                    </div>
                    <div>
                        <div class="bar bar8"></div>
                        <div class="label">Mar</div>
                    </div>
                    <div>
                        <div class="bar bar6"></div>
                        <div class="label">Apr</div>
                    </div>
                    <div>
                        <div class="bar bar3"></div>
                        <div class="label">May</div>
                    </div>
                    <div>
                        <div class="bar bar4"></div>
                        <div class="label">Jun</div>
                    </div>
                    <div>
                        <div class="bar bar3"></div>
                        <div class="label">Jul</div>
                    </div>
                    <div>
                        <div class="bar bar7"></div>
                        <div class="label">Aug</div>
                    </div>
                    <div>
                        <div class="bar bar5"></div>
                        <div class="label">Sep</div>
                    </div>
                    <div>
                        <div class="bar bar3"></div>
                        <div class="label">Oct</div>
                    </div>
                    <div>
                        <div class="bar bar5"></div>
                        <div class="label">Nov</div>
                    </div>
                    <div>
                        <div class="bar bar6"></div>
                        <div class="label">Dec</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="title">
                    <p>Orders <span>(order Placed Quantity)</span></p>
                    <div>
                        <div>
                            <p>May, 2024</p>
                        </div>
                        <select name="time" id="time">
                            <option value="monthly">Monthly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="chart chart-two">
                    <div>
                        <div class="bar bar4"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar7"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar2"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar8"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar6"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar4"></div>
                        <div class="label">set, 21</div>
                    </div>
                    <div>
                        <div class="bar bar7"></div>
                        <div class="label">set, 21</div>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="dashboard-order">Orders</h1>
        <div class="search_refresh">
            <div>
                <img src="assets/images/search.png" alt="varasa search icon">
                <input type="text" name="search" id="search" placeholder="Search" autofocus>
            </div>
            <button class="Refresh">
                <img src="assets/images/refresh.png" alt="varasa refresh icon">
                <p>Refresh</p>
            </button>
        </div>

        <!-- active/pending/complete button -->
        <div class="order-type-btn">
            <div class="lefts-btn">
                <button>Active</button>
                <button>Pending</button>
                <button>Complete</button>
            </div>
            <div class="right-btns">
                <div>
                    <p>Date</p>
                    <input type="date" name="date" id="date">
                </div>
                <div>
                    <p>Payment Type</p>
                    <select name="Payment-Type" id="Payment-Type">
                        <option value="Payment Type">Payment Type</option>
                        <option value="Payment Type">Payment Type</option>
                        <option value="Payment Type">Payment Type</option>
                        <option value="Payment Type">Payment Type</option>
                    </select>
                </div>
                <div>
                    <p>Area Wise</p>
                    <select name="Select-Area" id="Select-Area">
                        <option value="Select Area">Select Area</option>
                        <option value="Payment Type">Payment Type</option>
                        <option value="Payment Type">Payment Type</option>
                        <option value="Payment Type">Payment Type</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- order box start -->
        <h4 class="card-title " style="margin-top: 2rem;">No order Found</h4>
        <!-- <div class="Order-box-section">
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
                <div class="Order-box">
                    <div class="order-time">
                        <p>Order ID : <b>A240125-009</b></p>
                        <div>
                            <p>Order Date : <b>May 11, 2020 . 07:44 PM</b></p>
                            <p>Service Time: <b>May 11, 2024 - May 30, 2024</b></p>
                        </div>
                    </div>
                    <div class="order-img">
                        <img src="assets/images/profile icon.png" alt="">
                        <p>Nursing Service Weekly <br>7 days - 12 hours</p>
                    </div>
                    <hr class="order-hr">
                    <div class="order-amount">
                        <div>
                            <p>Payment: <b>Cash</b></p>
                            <p>Amount : <b>2000 BDT</b></p>
                        </div>
                        <a href="OrderDetails.html">
                            <p>View Order</p>
                        </a>
                    </div>
                </div>
            </div> -->
        <!-- order box end -->
    </div>
    <!-- page section end -->
    </div>
    </div>
@endsection
