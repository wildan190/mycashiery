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
                        <h4 class="mt-4">Fitur yang tersedia:</h4>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Transaksi</h5>
                                    <small>3 new</small>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Transaksi pembelian</li>
                                    <li class="list-group-item">Transaksi penjualan</li>
                                    <li class="list-group-item">Transaksi pengembalian</li>
                                </ul>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Manajemen Produk</h5>
                                    <small>3 new</small>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Manajemen produk</li>
                                    <li class="list-group-item">Manajemen kategori produk</li>
                                </ul>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Manajemen User</h5>
                                    <small>3 new</small>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Manajemen user</li>
                                </ul>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Laporan</h5>
                                    <small>3 new</small>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Laporan transaksi</li>
                                    <li class="list-group-item">Laporan stok</li>
                                    <li class="list-group-item">Laporan pendapatan</li>
                                </ul>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Payment</h5>
                                    <small>3 new</small>
                                </div>
                                <p class="mb-1">Payment Gateaway dengan pilihan yang lengkap termasuk Akulaku Paylater dan Shopee Pay, dan Gopay Later</p>
                            </a>
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
                        <p class="text-center mb-0">Lisensi Terbuka: <a href="https://www.gnu.org/licenses/gpl-3.0.html" target="_blank">GNU General Public License v3.0</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

