<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Website</title>

    <link rel="icon" type="image/png"
        href="https://images.pexels.com/photos/5199144/pexels-photo-5199144.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        alt="Image" width="40px" height="40px">
    <style>
    body {
        overflow: auto;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        font-weight: 400;
        background-image: url("https://st.quantrimang.com/photos/image/2020/07/30/Hinh-Nen-Trang-32.jpg");
        font-family: "Times New Roman", Times, serif;
    }

    .header {
        color: #000000;
        font-size: 20px;
        text-align: center;
        font-family: "poppins", sans-serif;
    }

    .col5 {
        border-radius: 10px;
        width: 400px;
        height: 250px;
        overflow: hidden;
    }

    .col5 img {
        width: 100%;
        height: 150%;
        object-fit: cover;
    }

    .col6 {
        width: 400px;
        height: 250px;
        overflow: hidden;
    }

    .col6 h2 {
        font-size: 45px;
        line-height: 0.4px;
    }

    .col6 p {
        font-size: 15px;
    }

    .col6 p {
        text-align: center;
        padding: 40px;
    }

    section {
        border-radius: 15px;
        max-width: 700px;
        margin: 20px auto;
        background-color: #ffe6f7;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .lop5 {
        border-radius: 15px;
        width: 1000px;
        height: 240px;
        overflow: hidden;
    }

    .lop5 img {
        width: 50%;
        height: 160%;
        object-fit: cover;
    }

    .lop6 {
        width: 1000px;
        height: 240px;
        overflow: hidden;
    }

    .lop6 h2 {
        font-size: 45px;
        line-height: 0;
    }

    .lop6 h2:hover {
        color: rgb(4, 33, 37);
    }

    .lop6 p {
        font-size: 13px;
    }

    .lop6 p {
        text-align: center;
        padding: 40px;
    }

    .lop6 p:hover {
        color: aliceblue;
    }

    .lop {
        display: flex;
        justify-content: space-between;
    }

    a.chu {
        position: relative;
        font-family: segoe ui;
        text-decoration: none;
        font-size: 20px;
        font-family: "Times New Roman", serif;
    }

    a.chu:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0%;
        height: 1px;
        transition: 0.4s;
    }

    a.chu:hover:after {
        width: 100%;
        left: 0;
    }

    .lo,
    .lop1,
    .lop2,
    .lop3 {
        width: 100%;
        height: 100%;
    }

    .lo {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .lo .lop1 {
        top: 0;
        left: 0;
        position: absolute;
        transition: 0.4s;
    }

    .lo:hover .lop1 {
        transform: scale(1.2);
    }

    .lo .lop2 {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;

        transition: 0.4s;
    }

    .lo:hover .lop2 {
        opacity: 0.4;
        transform: scale(1.2);
    }

    .lo .lop3 {
        position: relative;
        display: inline-block;
        position: absolute;
        top: 90px;
        left: 55px;
        color: white;
        font-size: 30px;
        opacity: 0;
        transition: 0.4s;
    }

    .lo .lop3 i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        color: white;
    }

    .lo:hover .lop3 {
        opacity: 1;
    }

    @media screen and (max-width: 700px) {
        .lop6 h2 {
            font-size: 25px;
        }

        .lop6 p {
            font-size: 10px;
        }
    }

    @media screen and (min-width: 701px) {
        .lop6 h2 {
            font-size: 45px;
        }

        .lop6 p {
            font-size: 13px;
        }
    }

    .bod {
        display: flex;
        justify-content: space-between;
    }

    .container {
        position: fixed;
        top: 0;
        left: 0;
        width: 30%;
        z-index: 9999;
        transition: transform 0.3s;
        display: flex;
        align-items: center;
        max-width: auto;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        color: #000000;
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        padding: 0px;
        overflow: hidden;
        font-family: "Kalnia", cursive;
        padding: 10px;
    }

    .header img {
        height: 50px;
        transition: transform 0.3s;
    }

    .header.scrolled {
        transform: translateY(-100%);
    }

    .header.scrolled img {
        transform: translateY(100%);
    }

    .containey {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 20px;
    }

    @media (max-width: 500px) {
        .containey {
            grid-template-columns: repeat(1, 1fr);
            width: 70%;
            float: none;
        }
    }

    .item {
        position: relative;
        overflow: hidden;
    }

    .item img {
        width: 100%;
        height: 430px;
        image-rendering: optimizeSpeed;
        image-rendering: -moz-crisp-edges;
        image-rendering: -webkit-optimize-contrast;
        image-rendering: -o-crisp-edges;
        image-rendering: pixelated;
        -ms-interpolation-mode: nearest-neighbor;
    }

    .item .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        color: #ffffff;
        opacity: 1;
        transition: opacity 1 ease;
    }

    .item:hover .overlay {
        opacity: 0.8;
    }

    .item .overlay p {
        margin: 10px;
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    }

    a {
        color: rgb(255, 255, 255);
        opacity: 1;
        text-decoration: none;
    }

    a:hover {
        color: rgb(0, 0, 0);
    }

    a:active {
        color: green;
    }

    .a:visited {
        color: purple;
    }

    footer {
        text-align: left;
        color: #000000;
        background-color: #ffcce0;
        font-family: "Times New Roman", serif;
        padding: 13px;
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .footer {
        color: #ffffff;
        text-align: right;
        padding: 10px;
    }

    .footer a {
        color: rgb(2, 117, 79);
        opacity: 1;
        text-decoration: none;
        font-size: 15px;
    }

    .footer a:hover {
        color: rgb(240, 223, 130);
    }

    .lop6 h2:hover {
        color: rgb(4, 33, 37);
    }

    .lop6 p:hover {
        color: aliceblue;
    }
    </style>
</head>

<body>

    <section>
        <div class="bod">
            <div class="col5">
                <img src="https://images.pexels.com/photos/837255/pexels-photo-837255.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                    alt="1">
            </div>
            <div class="col6">
                <h2>Portfolio</h2>
                <p>Trần Thu Hằng <br>
                    MSV: 222001445 <br>
                    LỚP:CNTT-D2022B</p>
            </div>
        </div>
    </section>
    <div class="containey">
        <div class="item">
            <img src="https://images.pexels.com/photos/4587960/pexels-photo-4587960.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="Image 1">
            <div class="overlay">
                <p>
                <h2>Buổi 1:</h2>
                </p>
                <a href="http://laptrinhweb19.000.pe/bai1.php">Bài 1</a>
                <a href="http://laptrinhweb19.000.pe/bai2.php?i=1">Bài 2</a>
                <a href="http://laptrinhweb19.000.pe/bai3.php">Bài 3</a>

            </div>
        </div>
        <div class="item">
            <img src="https://images.pexels.com/photos/4587963/pexels-photo-4587963.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="Image 2">
            <div class="overlay">
                <p>
                <h2>Buổi 2:</h2>
                </p>
                <a href="http://laptrinhweb19.000.pe/Bai3buoi2.php">Bài 3</a>
                <a href="http://laptrinhweb19.000.pe/Bai4.php">Bài 4</a>


            </div>
        </div>
        <div class="item">
            <img src="https://images.pexels.com/photos/4588069/pexels-photo-4588069.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="Image 3">
            <div class="overlay">
                <p>
                <h2>Buổi 3:</h2>
                </p>
                <a href="">Bài 1</a>
                <a href="">Bài 2</a>
                <a href="">Bài 3</a>
            </div>
        </div>
        <div class="item">
            <img src="https://images.pexels.com/photos/4588444/pexels-photo-4588444.jpeg" alt="Image 4">
            <div class="overlay">
                <p>
                <h2>Buổi 4</h2>
                </p>
                <a href="">Bài 1</a>
                <a href="">Bài 2</a>
                <a href="">Bài 3</a>
            </div>
        </div>
        <div class="item">
            <img src="https://images.pexels.com/photos/4588018/pexels-photo-4588018.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="Image 5">
            <div class="overlay">

                <p>
                <h2>Buổi 5:</h2>
                </p>
                <a href="">Bài 1</a>
                <a href="">Bài 2</a>
                <a href="">Bài 3</a>
            </div>
        </div>
        <div class="item">
            <img src="https://images.pexels.com/photos/4587959/pexels-photo-4587959.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="Image 6">
            <div class="overlay">
                <p>
                <h2>Buổi 6:</h2>
                </p>
                <a href="">Bài 1</a>
                <a href="">Bài 2</a>
                <a href="">Bài 3</a>
            </div>
        </div>
        <div class="item">
            <img src="https://images.pexels.com/photos/4587993/pexels-photo-4587993.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="Image 7">
            <div class="overlay">
                <p>
                <h2>Buổi 7:</h2>
                </p>
                <a href="">Bài 1</a>
                <a href="">Bài 2</a>
                <a href="">Bài 3</a>
            </div>
        </div>
        <div class="item">
            <img src="https://images.pexels.com/photos/4587952/pexels-photo-4587952.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="Image 8">
            <div class="overlay">
                <p>
                <h2>Buổi 8:</h2>
                </p>
                <a href="">Bài 1</a>
                <a href="">Bài 2</a>
                <a href="">Bài 3</a>
            </div>
        </div>

    </div>
    </div>

</html>

<script src="./b1.js"></script>

</html>