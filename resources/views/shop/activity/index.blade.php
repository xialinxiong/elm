@extends("shop.layouts.main")
@section("title","活动列表")
@section("content")

    <table class="table">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动详情</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
        </tr>
        @foreach($datas as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{!!$data->content!!}</td>
                <td>{{$data->start_time}}</td>
                <td>{{$data->end_time}}</td>
            </tr>
        @endforeach

    </table>


@endsection

