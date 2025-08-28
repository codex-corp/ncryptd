<div class="row form-row">
    <h4 class="semi-bold">File: <span class="light">{{$exclude['FileID']}}</span></h4>
    <br>

    <div class="col-md-6">
        <label>Exclude Functions</label>
        <input type="text" value="{{implode(',',$exclude['functions'])}}" id="exclude_functions[]" placeholder="" />
    </div>
    <div class="col-md-6">
        <label>Exclude Variables (without $)</label>
        <input type="text" value="{{implode(',',$exclude['vars'])}}" id="exclude_vars[]" placeholder="" />
    </div>
</div>