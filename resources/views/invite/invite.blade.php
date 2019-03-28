@extends('layouts.particles')

@section('css')
    <style>
        #content {
            background-color: rgba(255, 255, 255, 0.8);
            border: solid 1px white;
            border-radius: 10px;
            margin: auto;
            padding: 1em;
            text-align: center;
            color: black !important;
            font-family: '微软雅黑', 'Open Sans', Helvetica, Arial, sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="text-center col-lg-offset-3 col-lg-7" id="content">
        <h1 style="color:black">欢迎加入我们</h1>
        <hr>
        <p style="color:black">
            明明看起来是宁静的夜晚，又隐隐有不安的气氛在空气中骚动。<br>
            人，无处不在。除了CBD这样的大雅之堂，也存在于街头巷尾这样的灰色地带。各色人等，繁复纷杂。<br>
            所谓灰色，正是黑与白的混合，所谓虚无，正是无处不在而若无。<br>
            你又在哪？<br>
            如果你不明白自己身处何处，何不来与我们尝试接触？<br>
            试试这个门牌715997214吧，它也许不会让你找到贝克街221B，但它能让你看到一个更完整的世界。<br>
        </p>
    </div>
@endsection