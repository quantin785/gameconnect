<?php
/**
 * Vue pour la liste des posts
 * Variables disponibles: $postsWithComments, $userId, $username
 */
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LevelUp</title>

    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <link rel="stylesheet" href="../assets/css/libs.min.css">
    <link rel="stylesheet" href="../assets/css/socialv.css?v=4.0.0">
    <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="../assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome-line-awesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">

</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="iq-navbar-logo d-flex justify-content-between">
                    <a href="../html/index.php">
                        <img src="../assets/images/logo.png" class="img-fluid" alt="">
                        <span>LevelUp</span>
                    </a>
                </div>
                <div class="iq-search-bar device-search">
                    <form action="#" class="searchbox">
                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                        <input type="text" class="text search-input" placeholder="Search here...">
                    </form>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  ms-auto navbar-list">

                        <li class="nav-item dropdown">
                            <a href="#" class="   d-flex align-items-center dropdown-toggle" id="drop-down-arrow"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../assets/images/user/1.png" style="width: 30px; height: 100%;" class=" me-3" alt="user">
                                <div class="caption">
                                    <h6 class="mb-0 line-height"><?= secure($username) ?></h6>
                                </div>
                            </a>
                            <div class="sub-drop dropdown-menu caption-menu" aria-labelledby="drop-down-arrow">
                                <div class="card shadow-none m-0">
                                    <div class="card-header  bg-primary">
                                        <div class="header-title">
                                            <h5 class="mb-0 text-white">Hello <?= secure($username) ?></h5>
                                            <span class="text-white font-size-12">Available</span>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 ">
                                        <div class="d-inline-block w-100 text-center p-3">
                                            <a class="btn btn-primary iq-sign-btn" href="../service/logout.php"
                                                role="button">Sign
                                                out<i class="ri-login-box-line ms-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- Wrapper Start -->
    <div class="container">
    <div class="row">
        <div class="col-lg-12 row m-0 p-0">
            <div class="col-sm-12">
                <div id="post-modal-data" class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Create Post</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="user-img">
                                <img src="../assets/images/user/1.png" style="width: 50px; height: 100%;" alt="userimg"
                                    class="avatar-60 rounded-circle">
                            </div>
                            <form class="post-text ms-3 w-100" data-bs-toggle="modal" data-bs-target="#post-modal">
                                <input type="text" class="form-control rounded"
                                    placeholder="Write something here..." style="border:none;">
                            </form>
                        </div>
                        <hr>
                    </div>
                    <div class="modal fade" id="post-modal" tabindex="-1" aria-labelledby="post-modalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-sm-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="post-modalLabel">Create Post</h5>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="ri-close-fill"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="post-text ms-3 w-100" action="../public/add-post.php"
                                        method="post" enctype="multipart/form-data">
                                        <textarea name="content" class="form-control rounded"
                                            placeholder="Write something here..." style="border:none;" rows="3"></textarea>

                                        <div class="mt-3 d-flex align-items-center">
                                            <input type="file" name="media" class="form-control me-2">
                                        </div>
                                        <button type="submit" class="btn btn-primary d-block w-100 mt-3">Post</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php foreach ($postsWithComments as $post): ?>
            <div class="col-sm-12">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="user-post-data">
                            <div class="d-flex justify-content-between">
                                <div class="me-3">
                                    <img class="rounded-circle img-fluid" src="../assets/images/user/1.png"
                                        style="width: 50px;" alt="">
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-0 d-inline-block"><?= secure($post['username']) ?></h5>
                                            <span class="mb-0 d-inline-block">Add New Post</span>
                                            <p class="mb-0 text-primary">
                                                <?= time_elapsed_string($post['created_at']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <p><?= secure($post['content']) ?></p>
                        </div>

                        <div class="user-post">
                            <?php if ($post['media']): ?>
                                <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $post['media'])): ?>
                                    <img src="../uploads/<?= secure($post['media']) ?>" alt="Image"
                                        style="max-width:100%;">
                                <?php else: ?>
                                    <video controls style="max-width:100%;">
                                        <source src="../uploads/<?= secure($post['media']) ?>" type="video/mp4">
                                        Votre navigateur ne supporte pas la vidéo.
                                    </video>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="comment-area mt-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="like-block position-relative d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="like-data">
                                            <span role="button">
                                                <img src="../assets/images/icon/01.png" class="img-fluid" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="total-like-block ms-2 me-3">
                                        <span role="button">
                                            <?= secure($post['like_count']) ?> Likes
                                        </span>
                                    </div>
                                </div>

                                <div class="total-comment-block">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" role="button">
                                            <?= count($post['comments']) ?> Commentaire(s)
                                        </span>
                                        <div class="dropdown-menu">
                                            <?php foreach ($post['comments'] as $comment): ?>
                                                <a class="dropdown-item" href="#">
                                                    <?= secure($comment['username']) ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <?php if (!empty($post['comments'])): ?>
                                <ul class="post-comments list-inline p-0 m-0">
                                    <?php foreach ($post['comments'] as $comment): ?>
                                        <li class="mb-2">
                                            <div class="d-flex">
                                                <div class="user-img">
                                                    <img src="../assets/images/user/1.png" alt="userimg"
                                                        style="width: 20px">
                                                </div>
                                                <div class="comment-data-block ms-3">
                                                    <h6><?= secure($comment['username']) ?></h6>
                                                    <span class="text-primary">
                                                        <?= time_elapsed_string($comment['created_at']) ?>
                                                    </span>
                                                    <p class="mb-0"><?= secure($comment['comment']) ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>Aucun commentaire</p>
                            <?php endif; ?>

                            <form action="../public/add-comment.php" method="post"
                                class="comment-text d-flex align-items-center mt-3">
                                <input type="text" name="comment" class="form-control rounded"
                                    placeholder="Enter Your Comment">
                                <div class="comment-attagement d-flex">
                                    <input type="hidden" name="post_id"
                                        value="<?= secure($post['post_id']) ?>">
                                    <button class="btn btn-primary" type="submit">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="col-sm-12 text-center">
            <img src="../assets/images/page-img/page-load-loader.gif" alt="loader" style="height: 100px;">
        </div>
    </div>
</div>

    <!-- Wrapper End-->
    <footer class="iq-footer bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="../dashboard/privacy-policy.html">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="../dashboard/terms-of-service.html">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    Copyright 2020 <a href="#">SocialV</a> All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/libs.min.js"></script>
    <!-- slider JavaScript -->
    <script src="../assets/js/slider.js"></script>
    <!-- masonry JavaScript -->
    <script src="../assets/js/masonry.pkgd.min.js"></script>
    <!-- SweetAlert JavaScript -->
    <script src="../assets/js/enchanter.js"></script>
    <!-- SweetAlert JavaScript -->
    <script src="../assets/js/sweetalert.js"></script>
    <!-- app JavaScript -->
    <script src="../assets/js/charts/weather-chart.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>
    <script src="../assets/js/lottie.js"></script>

    <!-- offcanvas start -->
    <div class="offcanvas offcanvas-bottom share-offcanvas" tabindex="-1" id="share-btn"
        aria-labelledby="shareBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="shareBottomLabel">Share</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <div class="d-flex flex-wrap align-items-center">
                <div class="text-center me-3 mb-3">
                    <img src="../assets/images/icon/08.png" class="img-fluid rounded mb-2" alt="">
                    <h6>Facebook</h6>
                </div>
                <div class="text-center me-3 mb-3">
                    <img src="../assets/images/icon/09.png" class="img-fluid rounded mb-2" alt="">
                    <h6>Twitter</h6>
                </div>
                <div class="text-center me-3 mb-3">
                    <img src="../assets/images/icon/10.png" class="img-fluid rounded mb-2" alt="">
                    <h6>Instagram</h6>
                </div>
                <div class="text-center me-3 mb-3">
                    <img src="../assets/images/icon/11.png" class="img-fluid rounded mb-2" alt="">
                    <h6>Google Plus</h6>
                </div>
                <div class="text-center me-3 mb-3">
                    <img src="../assets/images/icon/13.png" class="img-fluid rounded mb-2" alt="">
                    <h6>In</h6>
                </div>
                <div class="text-center me-3 mb-3">
                    <img src="../assets/images/icon/12.png" class="img-fluid rounded mb-2" alt="">
                    <h6>YouTube</h6>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
