@inject('categoryPresenter','App\Presenters\Admin\CategoryPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="showBox">
  <div class="ibox-title">
    <h5>{{trans('common.show').trans('category.desc')}}</h5>
    <div class="ibox-tools">
      <a class="close-link">
          <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal" id="showForm">
      <div class="form-group">
        <label class="col-sm-3 control-label">{{trans('category.name')}}</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$category->name}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">{{trans('category.pid')}}</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$categoryPresenter->topCategoryName($categorys,$category->pid)}}</p>
        </div>
      </div>

      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">{{trans('category.hot')}}</label>
        <div class="col-sm-9">
          <p class="form-control-static">@if($category->hot == 0) 否 @else 是 @endif</p>
        </div>
      </div>
      @for ($i = 0; $i < count($category->norm); $i++)
        @if($category->norm[$i]->title)
          <div id="norms_{{$i}}">
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label">{{trans('category.norms')}}{{$i}}</label>
              <div class="col-sm-9">
                <p class="form-control-static">{{$category->norm[$i]->title}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label">{{trans('category.norms_para')}}{{$i}}</label>
              @for($j=0;$j< count($category->norm[$i]->para);$j++)
                @if($category->norm[$i]->para[$j]->name)
              <div class="col-sm-2">
                <p class="form-control-static">{{$category->norm[$i]->para[$j]->name}}</p>
              </div>
                @endif
              @endfor
            </div>

          </div>
        @endif
      @endfor
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-3 control-label">{{trans('category.sort')}}</label>
        <div class="col-sm-9">
          <p class="form-control-static">{{$category->sort}}</p>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
              <a class="btn btn-white close-link">{!!trans('common.close')!!}</a>
          </div>
      </div>
    </form>
  </div>
</div>