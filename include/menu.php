<header class="sticky-top bg-light border-bottom shadow-sm">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
            <a href="<?php echo $base_url; ?>/index.php" class="navbar-brand fw-bold">
            🍔 FestFood
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?php echo $base_url; ?>/index.php" class="nav-link">🏠 Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $base_url; ?>/product-list.php" class="nav-link">📦 Product List</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $base_url; ?>/cart.php" class="nav-link position-relative">
                            🛒 Cart

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <style>
        .navbar-nav .nav-link {
    position: relative;
    padding-bottom: 5px;
    transition: color 0.3s ease-in-out;
}

.navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0%;
    height: 2px;
    background-color:rgb(0, 140, 255); /* สีของเส้นขีด */
    transition: width 0.3s ease-in-out;
}

.navbar-nav .nav-link:hover {
    color:rgb(0, 140, 255); /* เปลี่ยนสีตัวอักษรเมื่อ hover */
}

.navbar-nav .nav-link:hover::after {
    width: 100%; /* ขยายเส้นขีดจาก 0% → 100% */
}
    </style>
</header>