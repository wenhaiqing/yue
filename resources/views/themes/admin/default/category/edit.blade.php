@inject('categoryPresenter','App\Presenters\Admin\CategoryPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="createBox">
  <div class="ibox-title">
    <h5>{{trans('common.edit').$category->name.trans('category.desc')}}</h5>
    <div class="ibox-tools">
      <a class="close-link">
          <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content">
    <form method="post" action="{{route('category.update', [encodeId($category->id, 'category')])}}" class="form-horizontal" id="editForm">
      {!!csrf_field()!!}
      {{method_field('PUT')}}
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.name')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="{{$category->name}}" name="name">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.pid')}}</label>
        <div class="col-sm-10">
          <select data-live-search="true" class="selectpicker form-control" name="pid">
            {!!$categoryPresenter->topCategoryList($categorys, $category->pid)!!}
          </select>
        </div>
      </div>

      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('category.hot')}}</label>
        <div class="col-sm-10">
          <select data-placeholder="{{trans('category.hot')}}" data-live-search="true" class="selectpicker form-control" name="hot">
            <option value="0" @if($category->hot == 0) selected @endif>否</option>
            <option value="1" @if($category->hot == 1) selected @endif>是</option>
          </select>
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
      @for ($i = 0; $i < count($norms); $i++)
        @if($norms[$i]['norm'])
        <div id="norms_{{$i}}">
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">{{trans('category.norms')}}{{$i}}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$norms[$i]['norm']}}" placeholder="例如:自驾分类的车辆来源,车辆类型，这里只能填单个" name="norms[{{$i}}][norm]">
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">{{trans('category.norms_para')}}{{$i}}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$norms[$i]['para']}}" placeholder="例如:车辆类型有轿车，越野车，这里多个用英文逗号分隔" name="norms[{{$i}}][para]">
            </div>
          </div>
        </div>
        @endif
      @endfor

      <div class="hr-line-dashed"></div>
      <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
            <a class="btn btn-white close-link">{!!trans('common.close')!!}</a>
            <button class="btn btn-primary editButton ladda-button"  data-style="zoom-in">{!!trans('common.edit')!!}</button>
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
      from: "{{$category->sort}}"
  });
</script>