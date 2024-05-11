@extends('layouts.default')
@section('content')
    <div class="main-container d-flex">
        @include('layouts/sidebar')
        <div class="content">
            <div class="container pt-5 ps-5">
                {{--                 <div class="d-flex">

                    <div class="pe-2">
                        <button class="btn"
                            style="outline: none;
                            border-radius: 5px;
                            background: #448512;
                            margin: 14px 0 16px 0;
                            width: 160px;
                            font-size: 20px;
                            padding: 7.5px;
                            height: fit-content;
                            font-family: 'Nunito', sans-serif;
                            color: #ffffff;">
                            Add
                        </button>
                    </div>
                    <div class="ps-4">
                        <button class="btn"
                            style="outline: none;
                            border-radius: 5px;
                            background: #DF151C;
                            margin: 14px 0 16px 0;
                            width: 160px;
                            font-size: 20px;
                            padding: 7.5px;
                            height: fit-content;
                            font-family: 'Nunito', sans-serif;
                            color: #ffffff;">
                            Delete
                        </button>
                    </div>

                </div> --}}

                @include('layouts/add_deck_modal')
                @include('layouts/edit_deck')

                <div class="container">
                    <div class="d-flex align-items-start top-con-label py-3">
                        <div class="col">
                            <div class="ps-5 fw-bold">Deck</div>
                        </div>
                        <div class="col fw-bold">
                            Description
                        </div>
                        <div class="col fw-bold">
                            Date created
                        </div>
                        <div class="col col-lg-2"></div>
                    </div>
                    <div class="scrollable-container">
                        <div class="add-content">

                            {{--                             <div class="row cen pt-3 pb-3 text-t">

                                <div class="col">
                                    <div class="ps-5 fw-bold">Science</div>
                                </div>
                                <div class="col">
                                    This deck is all about Science. Lorem ipsum, dolor sit amet consectetur adipisicing
                                    elit.
                                </div>
                                <div class="col">
                                    2020/10/25
                                </div>
                                <div class="col col-lg-2 d-flex">
                                    <div>
                                        <button class="btn"
                                            style="outline: none;
                                            border-radius: 2px;
                                            background: #1CCA00;
                                            margin: 14px 0 16px 0;
                                            width: 40px;
                                            font-size: 20px;
                                            padding: 7.5px;
                                            height: fit-content;
                                            color: #ffffff;
                                            border-radius: 12px;"
                                            data-bs-toggle="modal" data-bs-target="#edit_deck_modal">
                                            <i class="bi bi-pencil-square but"></i>
                                        </button>
                                    </div>
                                    <div class="ps-2">
                                        <button class="btn"
                                            style="outline: none;
                                                border-radius: 2px;
                                                background: red;
                                                margin: 14px 0 16px 0;
                                                width: 40px;
                                                font-size: 20px;
                                                padding: 7.5px;
                                                height: fit-content;
                                                color: #ffffff;
                                                border-radius: 12px;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}

                        </div>

                        <div class="add-but-main text-center">
                            <div class="row">
                                <button class="btn"
                                    style="outline: none;
                                        background: rgba(13, 16, 18, 0.325);
                                        font-size: 20px;
                                        padding: 7.5px;
                                        color: #ffffff;
                                        border-radius: 12px;"
                                    data-bs-toggle="modal" data-bs-target="#add_deck_modal">
                                    <i class="bi bi-plus-square"></i>
                                </button>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    loadDeck();

    function loadDeck() {
        fetch('/get-user-decks', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                document.querySelector('.add-content').innerHTML = '';

                data.userDecks.forEach(deck => {
                    const row = document.createElement('div');

                    // Parse and format the date
                    const createdDate = new Date(deck.created_at);
                    const formattedDate = createdDate.toLocaleDateString('en-US');

                    row.innerHTML = `
                <div class="row cen pt-3 pb-3 text-t">
                    <div class="col">
                        <div class="ps-5 fw-bold">${deck.name}</div>
                    </div>
                    <div class="col">${deck.description}</div>
                    <div class="col">${formattedDate}</div>
                    <div class="col col-lg-2 d-flex">
                        <div>
                            <button class="btn"
        style="outline: none;
            border-radius: 2px;
            background: #1CCA00;
            margin: 14px 0 16px 0;
            width: 40px;
            font-size: 20px;
            padding: 7.5px;
            height: fit-content;
            color: #ffffff;
            border-radius: 12px;"
        data-bs-toggle="modal"
        data-bs-target="#edit_deck_modal"
        onclick="editDeckAndLoadQuestion(${deck.user_deck_id})">
    <i class="bi bi-pencil-square but"></i>
</button>


                        </div>
                        <div class="ps-2">
                            <button name="delete" class="btn"
                            style="outline: none;
                                border-radius: 2px;
                                background: red;
                                margin: 14px 0 16px 0;
                                width: 40px;
                                font-size: 20px;
                                padding: 7.5px;
                                height: fit-content;
                                color: #ffffff;
                                border-radius: 12px;"
                                data-deck-id="${deck.user_deck_id}"
                                onclick="deckDelete(${deck.user_deck_id})">
                            <i class="bi bi-trash"></i>
                        </button>

                        </div>
                    </div>
                </div>
            `;

                    document.querySelector('.add-content').appendChild(row);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    function deckDelete(deckId) {
        fetch(`/deckdelete/${deckId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message);
                loadDeck(); // Assuming loadDeck() is a function to reload the deck list after deletion
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
</script>

<style>
    .cen {
        box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.06);
    }


    .top-con-label {
        border-bottom: 3px solid #DF151C;
        background: #ffffff;
        font-family: 'Nunito', sans-serif;
        border-radius: 12px;
        width: 1090px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        color: #626262;
        font-weight: 400;
        font-size: 20px;
        font-family: 'Nunito', sans-serif;
        margin: 3px 0 2px 0;
        flex-direction: row;
        justify-content: space-between;
        align-self: flex-start;
        box-sizing: border-box;
    }


    .scrollable-container {
        height: 610px;
        overflow-y: auto;
        /* Show vertical scrollbar when needed */
        overflow-x: hidden;
        /* Hide horizontal scrollbar */
        font-family: 'Nunito', sans-serif;
        box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.06);
        border-radius: 12px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        width: 1090px;
        background: #ffffff;
    }



    .content {
        background: #F8F1F1;
    }
</style>
