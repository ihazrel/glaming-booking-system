<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking form</title>
    <link rel="stylesheet" href="../style/nav.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/booking.css">
    <link rel="stylesheet" href="../style/footer.css">
</head>
<body>
<?php include('../util/nav.php');?>
<section>
    <div class="info-container">
        <form action="" method="post">
            <div class="info-bar">
                <div class="info-field" id="date">
                    <fieldset id="date">
                        <label>Select dates</label>
                        <div class="if-date">
                            <input type="date" class="date" value="2024-06-14">
                            <input type="date" class="date" value="2024-06-15">
                        </div>
                        </fieldset>
                </div>

                <div class="info-field">
                    <fieldset>
                        <label>Number of people</label>
                        <input type="number" class="people" placeholder="1" min="1" max="10">
                    </fieldset>
                </div>

                <div class="info-field">
                    <fieldset>
                        <label>Have a promocode?</label>
                        <input type="text" class="promocode">
                    </fieldset>
                </div>

                <input class="info-submit" type="submit" value="Apply">
            </div>
        </form>
    </div>

    <div class="book-container">
        <div class="book-room">

            <div class="room-container">
                <div class="rc-head">
                    <div class="rc-h-image"><img src="../pic/suite.png" alt="Lorem Ipsum"></div>
                    <div class="rc-h-desc">
                        <h2>Lorem ipsum</h2>
                        <p>Lorem ipsum | Lorem ipsum </p>
                    </div>
                </div>
                <div class="rc-body">
                    <div class="rc-b-choice">
                        <div class="rc-bc-title">
                            <h2>Lorem ipsum</h2>
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                        <div class="rc-bc-right">
                            <div class="rc-bc-price">
                                <p>MYR 91.44</p>
                            </div>
                            <button>
                                <span>Select</span>
                            </button> 
                        </div>                       
                    </div>

                    <div class="rc-b-choice">
                        <div class="rc-bc-title">
                            <h2>Lorem ipsum</h2>
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                        <div class="rc-bc-right">
                            <div class="rc-bc-price">
                                <p>MYR 91.44</p>
                            </div>
                            <button>
                                <span>Select</span>
                            </button> 
                        </div>                       
                    </div>

                    <div class="rc-b-choice">
                        <div class="rc-bc-title">
                            <h2>Lorem ipsum</h2>
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                        <div class="rc-bc-right">
                            <div class="rc-bc-price">
                                <p>MYR 91.44</p>
                            </div>
                            <button>
                                <span>Select</span>
                            </button> 
                        </div>                       
                    </div>
                </div>
            </div>

            <div class="room-container">
                <div class="rc-head">
                    <div class="rc-h-image"><img src="../pic/suite.png" alt="Lorem Ipsum"></div>
                    <div class="rc-h-desc">
                        <h2>Lorem ipsum</h2>
                        <p>Lorem ipsum | Lorem ipsum </p>
                    </div>
                </div>
                <div class="rc-body">
                    <div class="rc-b-choice">
                        <div class="rc-bc-title">
                            <h2>Lorem ipsum</h2>
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                        <div class="rc-bc-right">
                            <div class="rc-bc-price">
                                <p>MYR 91.44</p>
                            </div>
                            <button>
                                <span>Select</span>
                            </button> 
                        </div>                       
                    </div>

                    <div class="rc-b-choice">
                        <div class="rc-bc-title">
                            <h2>Lorem ipsum</h2>
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                        <div class="rc-bc-right">
                            <div class="rc-bc-price">
                                <p>MYR 91.44</p>
                            </div>
                            <button>
                                <span>Select</span>
                            </button> 
                        </div>                       
                    </div>

                    <div class="rc-b-choice">
                        <div class="rc-bc-title">
                            <h2>Lorem ipsum</h2>
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                        <div class="rc-bc-right">
                            <div class="rc-bc-price">
                                <p>MYR 91.44</p>
                            </div>
                            <button>
                                <span>Select</span>
                            </button> 
                        </div>                       
                    </div>
                </div>
            </div>

        </div>

        <div class="book-summary">
            <div class="bs-info" id="info">
                <h2>MYR 91.44</h2>
                <p>Tue, 11 June 24 – Wed, 12 June 24 </p>
                <p>1 room, 2 guests </p>
            </div>
            <hr>

            <div class="bs-info" id="price">
                <h3>Double Room School Holiday Flash Sale</h3>
                <div class="room-details">
                    <p>2 guests 1 night </p>
                    <p>MYR 91.44</p>
                </div>
            </div>
            <hr>
            
            <div class="bs-info" id="confirm">
                <div class="confirm-discount">
                    <h4>Discount</h4>
                    <p>MYR 0.00</p>
                </div>
                <div class="confirm-price">
                    <h3>Total price</h3>
                    <h3>MYR 91.44</h3>
                </div>
            </div>

            <button class="book">Book Now</button>
        </div>
    </div>
	
</section>
    <script src="../script/booking.js"></script>
<?php include('../util/footer.php');?>
</body>
</html>