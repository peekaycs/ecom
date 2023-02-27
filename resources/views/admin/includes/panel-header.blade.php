<div class="panel-header bg-primary-gradient">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h3 class="text-white fw-bold">{{$page_title ?? ''}}</h3>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="{{$manage_action ?? '#'}}" class="btn btn-white btn-border btn-round mr-2">{{$manage ?? "Manage"}}</a>
                @if(isset($page_action) && !empty($page_action))
                <a href="{{$page_action}}" class="btn btn-secondary btn-round">
                   {{$action_title ?? "Add"}}
                </a>
                @endif
            </div>
        </div>
    </div>
</div>