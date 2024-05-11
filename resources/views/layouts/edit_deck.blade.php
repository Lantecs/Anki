@extends('layouts.default')


<div class="modal fade" id="edit_deck_modal" tabindex="-1" aria-labelledby="edit_deck_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-body">

                <div class="row">
                    <div class="col col_desc_edit" id="col_desc_edit">
                        {{--                         <div class="form-group-edit mb-3">
                            <label for="deck-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="deck_name" name="deck_name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea name="deck_description" class="form-control" id="message-text" maxlength="150"
                                style="height: 250px; resize: none;"></textarea>
                        </div> --}}

                    </div>

                    <div class="col">
                        <div class="container">
                            <div>
                                <div class="text-center" style="">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Questions:</h1>
                                </div>
                            </div>
                            <div class="d-flex align-items-start col_name py-3">

                                <div class="col">
                                    <div class="ps-4">
                                        <div class="ps-5 fw-bold">Front</div>
                                    </div>
                                </div>
                                <div class="col fw-bold">
                                    Back
                                </div>
                            </div>

                            <div class="add_question_con">
                                <div class="add-content-question">

                                    {{--                                 <div class="row con-ques pt-3 pb-3 text-t">
                                        <div class="col">
                                            <p class="ps-5 fw-bold">What is 1 + 1?</p>
                                        </div>
                                        <div class="col">
                                            <p> Ambot nganong sa ako man ka mangutana</p>

                                        </div>
                                        <div class="col d-flex">
                                            <div class="ps-5">
                                                <button class="btn"
                                                    style="outline: none; border-radius: 2px; background: #1CCA00; margin: 14px 0 16px 0; width: 40px; font-size: 20px; padding: 7.5px; height: fit-content; color: #ffffff; border-radius: 12px;"
                                                    data-bs-toggle="modal" data-bs-target="#edit_deck_modal">
                                                    <i class="bi bi-pencil-square but"></i>
                                                </button>
                                            </div>
                                            <div class="ps-2">
                                                <button class="btn"
                                                    style="outline: none; border-radius: 2px; background: red; margin: 14px 0 16px 0; width: 40px; font-size: 20px; padding: 7.5px; height: fit-content; color: #ffffff; border-radius: 12px;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div> --}}


                                </div>

                                {{--                                 <div class="add-but text-center" id="add-but">
                                  <div class="row">
                                        <button class="btn"
                                            style="outline: none; background: rgba(13, 16, 18, 0.325); font-size: 20px; padding: 7.5px; color: #ffffff; border-radius: 12px;"
                                            onclick="addDeck()">
                                            <i class="bi bi-plus-square"></i>
                                        </button>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savedeck()">Save</button>
            </div>
        </div>
    </div>

</div>

<script>
    function editDeckAndLoadQuestion(deckId) {
        editDeck(deckId);
        loadQuestion(deckId);
    }

    function loadQuestion(deckId) {
        fetch(`/get-user-questions/${deckId}`, {
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
                if (data && data.deckQuestions) {
                    const addContentQuestion = document.querySelector('.add-content-question');
                    addContentQuestion.innerHTML = '';

                    data.deckQuestions.forEach(question => {
                        const row = document.createElement('div');
                        row.classList.add('row', 'con-ques', 'pt-3', 'pb-3', 'text-t');
                        row.innerHTML = `
                    <div class="col">
                        <p class="ps-5 fw-bold">${question.front}</p>
                    </div>
                    <div class="col">
                        <p>${question.back}</p>
                    </div>
                    <div class="col d-flex">

                        <div class="ps-5">
                            <button class="btn"
                                style="outline: none; border-radius: 2px; background: red; margin: 14px 0 16px 0; width: 40px; font-size: 20px; padding: 7.5px; height: fit-content; color: #ffffff; border-radius: 12px;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                        addContentQuestion.appendChild(row);
                    });

                    // Append the "Add Question" button
                    const addButtonHTML = `
                <div class="add-but text-center" id="add-but">
                    <div class="row">
                        <button class="btn"
                            style="outline: none; background: rgba(13, 16, 18, 0.325); font-size: 20px; padding: 7.5px; color: #ffffff; border-radius: 12px;"
                            onclick="addQuestion(${deckId})">
                            <i class="bi bi-plus-square"></i>
                        </button>
                    </div>
                </div>
            `;
                    addContentQuestion.insertAdjacentHTML('beforeend', addButtonHTML);
                } else {
                    console.error('No questions found for the deck.');
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    function saveQuestion(deckId) {
        const deckName = document.querySelector('#front').value;
        const deckDescription = document.querySelector('#back').value;

        const formData = new FormData();
        formData.append('front', deckName);
        formData.append('back', deckDescription);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/save-question/${deckId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    loadDeck();
                    console.log('Successfully Added!');
                    front.value = '';
                    back.value = '';

                    // Call loadQuestion() after successfully saving the question
                    loadQuestion(deckId);

                    // Hide the con-ques div after saving the question
                    const conQuesDiv = document.getElementById('con-quest');
                    if (conQuesDiv) {
                        conQuesDiv.style.display = 'none';
                    }
                } else if (data.errors) {
                    loadDeck();
                    console.error('Validation Errors:', data.errors);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }


    function addQuestion(deckId) {
        const addQuestionCon = document.querySelector('.add_question_con');
        const newQuestion = `
                        <div class="row con-ques pt-3 pb-3 text-t" id="con-quest">
                            <div class="col">
                                <textarea name="front" class="text_area" id="front"></textarea>
                            </div>
                            <div class="col">
                                <textarea name="back" class="text_area" id="back"></textarea>
                            </div>
                            <div class="col d-flex justify-content-center">
                                <div class="ps-1 pt-2">
                                    <button class="btn"
                                        onclick="saveQuestion(${deckId})"  // Pass deckId as a parameter
                                        style="outline: none; border-radius: 2px; background: #1CCA00; margin: 14px 0 16px 0; width: 40px; font-size: 20px; padding: 7.5px; height: fit-content; color: #ffffff; border-radius: 12px;">
                                        <i class="bi bi-check2" style="font-size: 25px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
            `;

        // Insert the new question HTML before the "Add Question" button
        addQuestionCon.insertAdjacentHTML('beforeend', newQuestion);

        // Hide the "Add Question" button
        const addButton = document.querySelector('.add-but');
        addButton.style.display = 'none';
    }


    function editDeck(deckId) {
        fetch(`/edit-deck/${deckId}`, {
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
                if (data.deck) {
                    const editDeck = data.deck;
                    const colDescEdit = document.getElementById('col_desc_edit');
                    if (colDescEdit) {
                        colDescEdit.innerHTML = `
                    <div class="text-center" style="">
                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">${editDeck.name}</h1>
                    </div>
                    <div class="form-group-edit mb-3">
                        <label for="deck-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" value="${editDeck.name}" id="deck_name" name="deck_name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea name="deck_description" class="form-control" id="message-text" maxlength="150" style="height: 250px; resize: none;">${editDeck.description}</textarea>
                    </div>`;
                    } else {
                        console.error('Element with id "col_desc_edit" not found');
                    }
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
</script>

<style>
    .text_area {
        border-radius: 5px;
        width: 170px;
        height: 80px;
        resize: none;
    }

    .add-content-question {
        border-top: 1px solid #181515;
    }

    .con-ques {
        box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.06);
        border-bottom: 1px solid #181515;
    }

    .col_name {
        background: #ffffff;
        font-family: 'Nunito', sans-serif;
        border-radius: 12px;
        width: 500px;
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

    .add_question_con {
        height: 400px;
        overflow-y: auto;
        overflow-x: hidden;
        font-family: 'Nunito', sans-serif;
        box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.06);
        border-radius: 12px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        width: 550px;
        background: #ffffff;
    }

    .modal-header {
        font-family: "Poppins", sans-serif;
    }

    .modal-title {
        color: #4671Ea;
        font-size: 28px;
        text-align: center;
    }
</style>
