<div id="OffcanvasWishlist" class="offcanvas offcanvas__right">
    <div class="offcanvas__wrapper">
        <h4 class="offcanvas__title">Избранное</h4>
        <ul class="offcanvas__list">
            <li class="offcanvas__item">
                <div class="offcanvas__product">
                    <a href="{{route('ProductDetailsPage')}}" class="offcanvas__img-wrapper">
                        <img src="{{asset('public/images/products_images/aments_products_image_6.jpg')}}" alt="" class="offcanvas__img">
                    </a>
                    <div class="offcanvas__content">
                        <a href="{{route('ProductDetailsPage')}}" class="offcanvas__name">Название</a>
                        <div class="offcanvas__details">
                            <span class="offcanvas__price">500 ₽</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas__btn-delete text-right">
                    <a href="#"><i class="fa fa-close"></i></a>
                </div>
            </li> <!-- .offcanvas__item -->
        </ul> <!-- .offcanvas__list -->
        <div class="offcanvas__list-btn">
            <a href="{{route('CartPage')}}" class="button  button--dark">Перейти в избранное</a>
        </div> <!-- .offcanvas__list-btn -->
    </div> <!-- .offcanvas__wrapper -->
</div> <!-- .offcanvas .offcanvas__right -->
