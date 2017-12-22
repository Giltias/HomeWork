<div class="modal fade" id="order"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGoodsLabel">Оформление заказа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="order" enctype="multipart/form-data">
                    <input type="hidden" name="order-goods-id" id="order-goods-id" value="">
                    <div class="row">
                        <div class="col">
                            Наименование товара: <span id="order-goods-name"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="order-email" class="col-form-label">E-mail:</label>
                                @if(Auth::guest())
                                    <input type="text" class="form-control" name="order-email" id="order-email">
                                @else
                                    <input type="text" class="form-control" name="order-email" id="order-email" value="{{ Auth::user()->email }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order-person" class="col-form-label">Укажите Ваше имя:</label>
                        <input class="form-control" name="order-person" id="order-person">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary" id="order-confirm">Купить</button>
            </div>
        </div>
    </div>
</div>

