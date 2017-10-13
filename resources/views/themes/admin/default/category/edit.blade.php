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
      @for ($i = 0; $i < count($category->norm); $i++)
        @if($category->norm[$i]->title)
          <div id="norms_{{$i}}">
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('category.norms')}}{{$i}}</label>
              <div class="col-sm-10">
                <input type="hidden" name="norms[{{$i}}][id]" value="{{$category->norm[$i]->id}}">
                <input type="text" class="form-control" value="{{$category->norm[$i]->title}}" placeholder="" name="norms[{{$i}}][norm]">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('category.norms_para')}}{{$i}}</label>
              @for($j=0;$j< count($category->norm[$i]->para);$j++)
                  <div class="col-sm-2">
                    <input type="hidden" value="{{$category->norm[$i]->para[$j]->id}}" name="norms[{{$i}}][para][{{$j}}][id]">
                    <input type="text" class="form-control" value="{{$category->norm[$i]->para[$j]->name}}" placeholder="" name="norms[{{$i}}][para][{{$j}}][para]">
                  </div>
              @endfor
              @for($j=count($category->norm[$i]->para);$j<10;$j++)
                <div id="paras_{{$i}}_{{$j}}" class="paras_{{$i}}" style="display:none">
                <div class="col-sm-2">
                  <input type="hidden" value="" name="norms[{{$i}}][para][{{$j}}][id]">
                  <input type="text" class="form-control" value="" placeholder="" name="norms[{{$i}}][para][{{$j}}][para]">
                </div>
                  </div>
              @endfor
              <div class="col-sm-1">
                <button id="btn_add_normpara{{$i}}" onclick="showpara('{{$i}}');" type="button" class="btn btn-warning">
                  <span class="glyphicon glyphicon-plus"></span>
                </button>
              </div>
            </div>
          </div>
        @endif
      @endfor
      @for ($i = count($category->norm); $i < 10; $i++)
        <div id="norms_{{$i}}" style="display:none">
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">{{trans('category.norms')}}{{$i}}</label>
            <div class="col-sm-10">
              <input type="hidden" name="norms[{{$i}}][id]" value="">
              <input type="text" class="form-control" value="" placeholder="例如:自驾分类的车辆来源,车辆类型，这里只能填单个" name="norms[{{$i}}][norm]">
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">{{trans('category.norms_para')}}{{$i}}</label>
            <div class="col-sm-2">
              <input type="hidden" value="" name="norms[{{$i}}][para][0][id]">
              <input type="text" class="form-control" value="" placeholder="" name="norms[{{$i}}][para][0][para]">
            </div>
            @for ($j = 1; $j < 10; $j++)
              <div id="paras_{{$i}}_{{$j}}" class="paras_{{$i}}" style="display:none">
                <div class="col-sm-2">
                  <input type="hidden" value="" name="norms[{{$i}}][para][{{$j}}][id]">
                  <input type="text" class="form-control" value="" placeholder="" name="norms[{{$i}}][para][{{$j}}][para]">
                </div>
              </div>
            @endfor
            <div class="col-sm-1">
              <button id="btn_add_normpara{{$i}}" onclick="showpara('{{$i}}');" type="button" class="btn btn-warning">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </div>
          </div>
        </div>
      @endfor

      <div class="col-sm-4 col-sm-offset-2">
        <button id="bt_add_keyword" type="button" class="btn btn-warning">
          <span class="glyphicon glyphicon-plus"></span> 添加分类规格
        </button>
      </div>

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

  var set_begin_num = {{count($category->norm)}};

  $('#bt_add_keyword').click(function(){
    console.log(set_begin_num);

    $('#norms_' + set_begin_num).show();

    if (set_begin_num >= 10) {

      $('#bt_add_keyword').hide();

    }

    set_begin_num++;

  });
  function showpara(i) {
    $(".paras_"+i).each(function(){
      //判断每一个div，其css中display是否为block
      if($(this).css("display")=="none"){
        $(this).show();return false;
      }
    });
  }
</script>