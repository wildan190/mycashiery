@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">About</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas fa-info fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="mt-4">MyCashiery</h4>
                            <p class="lead">Versi Aplikasi MyCashiery: 1.0</p>
                        </div>
                        <hr>
                        <p class="mb-0">Copyright &copy; 2023 PT Micro Padma Nusantara</p>
                        <p class="mb-0">Dibangun dengan <a href="https://laravel.com" target="_blank">Laravel Framework</a> dan <a href="https://getbootstrap.com" target="_blank">Bootstrap</a></p>
                        <p class="mb-0">Icon dari <a href="https://fontawesome.com" target="_blank">Font Awesome</a></p>
                        <hr>
                        <div class="text-center mt-2">
                            <a href="https://www.instagram.com/micropadmanusantara" target="_blank" style="color: #517fa4;">
                                <i class="fab fa-instagram fa-2x"></i>
                            </a>
                            <a href="https://www.facebook.com/micropadmanusantara" target="_blank" style="color: #1877f2;">
                                <i class="fab fa-facebook-square fa-2x"></i>
                            </a>
                            <a href="https://wa.me/62811144793" target="_blank" style="color: #25d366;">
                                <i class="fab fa-whatsapp fa-2x"></i>
                            </a>
                        </div>
                        <hr>
                        <p class="text-center mb-0">Developed by <a href="https://www.instagram.com/wildanbelfiore" target="_blank">Wildan Belfiore</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

