<div id="shopkeepers_found" class="row themed-background-muted" style="max-height: 512px; overflow: scroll; padding-top:20px;">
    @foreach($shopkeepers as $shopkeeper)
        <div class="col-sm-6 col-md-4">
            <a href="#modal-fade" data-shopkeeper="{{ $shopkeeper }}" data-toggle="modal" class="widget">
                <div class="widget-content text-right clearfix">
                    <img src="/images/placeholders/avatars/avatar9.jpg" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
                    <h3 class="widget-heading h4"><strong>{{ $shopkeeper->name }}</strong></h3>
                    <span class="text-muted"><i class="gi gi-iphone_shake"></i> {{ $shopkeeper->tel }}</span>
                </div>
            </a>
        </div>
    @endforeach
</div>