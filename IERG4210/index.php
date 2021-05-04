<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.6.0.min.js"></script>
    <script src="function.js"></script>
</head>
<body>
    <div class="container">
        <div class="shoppingList">
            <p class="text">
                <span class="short">Shopping List $50</span>
                <span class="long">Shopping List  Total:$50<br>
                    Buy 1 apple: $25<br>
                    Buy 1 orange: $25<br>
                    Total: $50<br>
                    <button class="button">Checkout</button></span>
            </p>
        </div>
        <div class="categoryList">
            <ul>
                <a href="food.html"><li>Food</li></a>
                <a href="drink.html"><li>Drink</li></a>
                <a href="admin.php"><li>Admin Page</li></a>
            </ul>
        </div>
        <div class="mainPage">
            <div class="categoryNav">
                <h3><a href="food.html" >Home</a>
                > <a href="food.html" >Food</a></h3> 
            </div>
            <div class="productList">
            <table>
                <colgroup>
                    <col width="33%">
                    <col width="33%">
                    <col width="34%">
                </colgroup>
                <tr>
                    <td><img class="thumbnail" id="apple" src="image/apple.jpg"></td>
                    <td><img class="thumbnail" id="orange" src="image/orange.jpg"></td>
                    <td><img class="thumbnail" id="banana" src="image/banana.jpg"></td>
                </tr>
                <tr>
                    <td><p><a href="apple.html">Apple</a></p></td>
                    <td><p><a href="orange.html">Orange</a></p></td>
                    <td><p><a href="banana.html">Banana</a></p></td>
                </tr>
                <tr>
                    <td><img class="thumbnail" id="broccoli" src="image/broccoli.jpg"></td>
                </tr>
                <tr>
                    <td><p><a href="broccoli.html">Broccoli</a></p></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</body>
</html>