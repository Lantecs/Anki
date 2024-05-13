@extends('layouts.default')
@section('content')
    <div class="main-container d-flex">
        @include('layouts/sidebar')
        <div class="content">
            <div class="container pt-5 ps-5">
                <div class="wel">
                    Welcome back, {{ Auth::user()->first_name }}!
                </div>
                <div>
                    <h3 class="pro">This is your progress. Do your best to remember it!</h3>
                </div>
                <div class="pt-5 pb-5">
                    <div class="container">
                        <div class="container">
                            <div class="container pe-5">
                                <div class="container pe-5">
                                    <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: 25%">25%</div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <div class="scrollable-container-home ps-5">
                    {{--
                    <div class="card-con d-flex">
                        <div>
                            <h3 class="con-title fw-bold">New words</h3>
                            <div class="con-text-col-min d-flex">
                                <div class="pe-5">
                                    <p>12 cards</p>
                                </div>
                                <div class="ps-4 pe-4">
                                    <i class="bi bi-dot ps-2"></i>
                                </div>
                                <div>
                                    <p>2020/09/27</p>
                                </div>
                            </div>
                        </div>
                        <button class="btn study-but"
                            style="        outline: none;
                        border-radius: 40px;
                        background: #F19A3E;
                        margin: 14px 0 16px 0;
                        width: 160px;
                        font-size: 20px;
                        padding: 7.5px;
                        height: fit-content;
                        color: #ffffff;">
                            Study
                        </button>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    loadDeckHome();

    function loadDeckHome() {
        fetch('/get-user-decks-home', {
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
                document.querySelector('.scrollable-container-home').innerHTML = '';

                data.userDecks.forEach(deck => {
                    const row = document.createElement('div');

                    // Parse and format the date
                    const createdDate = new Date(deck.created_at);
                    const formattedDate = createdDate.toLocaleDateString('en-US');

                    row.innerHTML = `

                    <div class="card-con d-flex">
                        <div>
                            <h3 class="con-title fw-bold">${deck.name}</h3>
                            <div class="con-text-col-min d-flex">
                                <div class="pe-5">
                                    <p>${deck.pages} cards</p>
                                </div>
                                <div class="ps-4 pe-4">
                                    <i class="bi bi-dot ps-2"></i>
                                </div>
                                <div>
                                    <p>${formattedDate}</p>
                                </div>
                            </div>
                        </div>
                        <button
                        onclick="studyDeck(${deck.user_deck_id})"
                         class="btn study-but"
                            style="outline: none;
                        border-radius: 40px;
                        background: #F19A3E;
                        margin: 14px 0 16px 0;
                        width: 160px;
                        font-size: 20px;
                        padding: 7.5px;
                        height: fit-content;
                        color: #ffffff;">
                            Study
                        </button>
                    </div>
            `;

                    document.querySelector('.scrollable-container-home').appendChild(row);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    function studyDeck(deckId) {
        window.location.href = `/studyboard`;
    }
</script>

<style>
    .scrollable-container-home::-webkit-scrollbar {
        display: none;
    }

    .con-text-col-min {
        color: #627D98;
    }

    .con-title {
        color: #2364AA;
    }

    .card-con {
        background: #FFFFFF;
        border-radius: 60px;
        position: relative;
        box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.06);
        margin-bottom: 35px;
        flex-direction: row;
        justify-content: space-between;
        padding: 18px 100px 10px 109.9px;
        width: 1050px;
        box-sizing: border-box;
    }

    .scrollable-container-home {
        height: 400px;
        overflow-y: auto;
        padding: 10px;
        font-family: 'Nunito', sans-serif;
        border-radius: 25px;
    }

    .content {
        background: #F8F1F1;
        font-family: 'Inter', sans-serif;
    }

    .wel {
        font-weight: 600;
        font-size: 35px;
        overflow-wrap: break-word;
    }

    .pro {
        font-weight: 600px;
        color: #5D5B5B;
    }
</style>
