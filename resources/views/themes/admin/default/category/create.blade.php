@inject('categoryPresenter','App\Presenters\Admin\CategoryPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="createBox">
  <div class="ibox-title">
    <h5>{{trans('common.create').trans('category.desc')}}</h5>
    <div class="ibox-tools">
      <a class="close-link">
          <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content">
    <form method="post" action="{{route('category.store')}}" class="form-horizontal" enctype="multipart/form-data">
      {!!csrf_field()!!}
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.name')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{{trans('category.name')}}" name="name">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.pid')}}</label>
        <div class="col-sm-10">
          <select data-placeholder="{{trans('category.pid')}}" data-live-search="true" class="selectpicker form-control" name="pid">
            {!!$categoryPresenter->topCategoryList($Categories)!!}
          </select>
        </div>
      </div>

      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.hot')}}</label>
        <div class="col-sm-10">
          <select data-placeholder="{{trans('category.hot')}}" data-live-search="true" class="selectpicker form-control" name="hot">
              <option value="0">否</option>
              <option value="1">是</option>
          </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">上传分类图片</label>
        <div class="col-sm-10">
          <input type="file" name="file">
        </div>
      </div>

      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.sort')}}</label>
        <div class="col-sm-10">
          <input type="text" id="sort"  name='sort' class="form-control"/>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
            <a class="btn btn-white close-link">{!!trans('common.close')!!}</a>
            <button type="submit"  data-style="zoom-in">{!!trans('category.create')!!}</button>
          </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $('.selectpicker').selectpicker();
  $('#sort').ionRangeSlider({
      type: "single",
      min: 0,
      max: 100,
      from: 0
  });
</script>