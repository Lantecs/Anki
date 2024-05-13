@extends('layouts.default')
@section('content')
    <div class="main-container d-flex">
        @include('layouts/sidebar')
        <div class="content">
            <div class="container pt-5">
                <div class="container pt-4">
                    <div class="container">
                        <div class="container">
                            <div class="container homecon bg-light">
                                <div class="container pt-3">
                                    <div class="container text-center">
                                        <h2 class="fw-bold">Science</h2>
                                    </div>
                                    <div class="container">
                                        <div class="container">
                                            <div class="container con-t-he">
                                                <div class="container">
                                                       <div class="container question-con-study">
                                                        <div class="row text-center">
                                                            <div class="row text-center">
                                                                <div class="col">
                                                                    <h4 class="colte">FRONT</h4>
                                                                </div>
                                                                <div class="col">
                                                                    <h4 class="colte">BACK</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col col-height col1">
                                                                <div class="pt-2">
                                                                    <p class="fs-5 pt-5">Which is the most abundant element in the universe?</p>
                                                                </div>

                                                            </div>
                                                            <div class="col col-height col2">
                                                                <div class="pt-2">
                                                                    <p class="fs-5 pt-5">Hydrogen is the most abundant element in the Universe and helium is second. Together they make up roughly 74% and 24% of all matter in the universe respectively.</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <button class="back"
                                            style="        outline: none;
                                            border-radius: 40px;
                                            background: #878E76;
                                            margin: 14px 0 16px 0;
                                            width: 100px;
                                            font-size: 20px;
                                            padding: 0px;
                                            height: fit-content;
                                            color: #ffffff;">Back</button>
                                    </div>
                                    <div class="ps-2 pe-5">
                                        <button class="next"
                                            style="        outline: none;
                                            border-radius: 40px;
                                            background: #F19A3E;
                                            margin: 14px 0 16px 0;
                                            width: 100px;
                                            font-size: 20px;
                                            padding: 0px;
                                            height: fit-content;
                                            color: #ffffff;">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .con-t-he {
        height: 473px;
    }

    .colte {
        color: #515151;
    }

    .col1 {
        border-right: 5px solid grey;
    }

    .col2 {
        border-left: 5px solid grey;
    }

    .col-height {
        height: 435px;
    }

    .question-con-study {
        height: 435px;
    }

    .homecon {
        height: 600px;
        border-radius: 20px;
        box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.1);
    }

    .content {
        background: #F8F1F1;
        font-family: 'Nunito', sans-serif;
    }
</style>
