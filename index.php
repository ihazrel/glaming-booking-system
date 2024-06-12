<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style/home-page.css">
</head>
<body>
    <div class="hero">

        <video autoplay loop muted plays-inline class="back-video">
            <source src="video/home-vid.mp4" type="video/mp4">
        </video>
    <?php include('pages/nav_index.php');?>
    <div class="content">
        <h1>Glaming Hotel</h1>
        <a href="#gallery">Welcome</a>
    </div>
    </div>

    <div>
        <section class="container" id="gallery">
            <h1>Hotels in each state</h1>
            <div class="cards row">
                <div class="card row">
                    <div class="card-body">
                        <div class="title">
                            <h2>Johor Bahru</h2>
                        </div>
                        <p>
                            Semua isi tentang hotel ini.
                        </p>
                    </div>
                </div>
                <div class="card row">
                    <div class="card-body">
                        <div class="title">
                            <h2>Pulau Pinang</h2>
                        </div>
                        <p>
                            Semua isi tentang hotel ini.
                        </p>
                    </div>
                </div>
                <div class="card row">
                    <div class="card-body">
                        <div class="title">
                            <h2>Pahang</h2>
                        </div>
                        <p>
                            Semua isi tentang hotel ini.
                        </p>
                    </div>
                </div>
                <div class="card row">
                    <div class="card-body">
                        <div class="title">
                            <h2>Selangor</h2>
                        </div>
                        <p>
                            Semua isi tentang hotel ini.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>