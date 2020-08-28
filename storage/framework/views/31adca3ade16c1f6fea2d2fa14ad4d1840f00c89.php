<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title> Web Geo</title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="top">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    
                    Web Geo
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?php echo e((request()->is('covid')) ? 'active' : ''); ?>">
                            <a class="nav-link" href="#">COVID Map <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php echo e((request()->is('world-map')) ? 'active' : ''); ?>">
                            <a class="nav-link" href="#">Explore <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="<?php echo e((request()->segment(1) == 'blog') ? 'active' : ''); ?>">
                            <a class="nav-link" href="<?php echo e(route('blog')); ?>">Blog <span
                                    class="sr-only">(current)</span></a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <?php if(Auth::user()->img): ?>
                                <img src="<?php echo e(route('get_avatar', ['img' => Auth::user()->img])); ?>" alt="profile_pic"
                                    style="width: 40px; height: 40px; border-radius: 50px;">
                                <?php endif; ?>
                                <span class="caret"><?php echo e(Auth::user()->f_name); ?></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo e(route('home')); ?>">
                                    <?php echo e(__('Administration')); ?>

                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                    style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <h1 class="text-center"><?php echo $__env->yieldContent('title'); ?></h1>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container">
            <div class="row row-cols-2">
                <div class="col-10">
                    <p class="text-center"><b> Web Geo - Just explore the world </b></p>
                    <span class="text-muted">Yassín Orlando Vázquez Paz</span>
                </div>
                <div class="col-2">
                    <a href="#top" style="color: white;">
                        <svg class="float-right" width="3em" height="3em" viewBox="0 0 16 16"
                            class="bi bi-arrow-up-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-10.646.354a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 6.207V11a.5.5 0 0 1-1 0V6.207L5.354 8.354z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views/layouts/app.blade.php ENDPATH**/ ?>