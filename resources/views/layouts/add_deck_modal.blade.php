@extends('layouts.default')


<div id="add_deck_modal" class="modal fade" tabindex="-1" aria-labelledby="add_deck_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adding New Deck</h1>
            </div>
            <div class="modal-body">
                <div class="addDeckInput">
                    <div class="form-group mb-3">
                        <label for="deck-name" class="col-form-label">Name:</label>
                        <input type="text" name="name" class="form-control" id="deck-name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea class="form-control" name="description" id="message-text" maxlength="150"
                            style="height: 150px; resize: none;"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addDeck()" data-bs-dismiss="modal">Add</button>
            </div>
        </div>
    </div>
</div>





<script>
    /*     document.addEventListener("DOMContentLoaded", function() {
        const addButton = document.querySelector('.add-but');

        addButton.addEventListener('click', function() {
            const addQuestionCon = document.querySelector('.add_question_con');
            const newQuestion = `
            <div class="row con-ques pt-3 pb-3 text-t">
                <div class="col">
                    <textarea name="deck_description" class="text_area" id="message-text"></textarea>
                </div>
                <div class="col">
                    <textarea name="deck_description" class="text_area" id="message-text"></textarea>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="ps-1 pt-2">
                        <button class="btn"
                            style="outline: none; border-radius: 2px; background: #1CCA00; margin: 14px 0 16px 0; width: 40px; font-size: 20px; padding: 7.5px; height: fit-content; color: #ffffff; border-radius: 12px;"
                            data-bs-toggle="modal" data-bs-target="#edit_deck_modal">
                            <i class="bi bi-check2" style="font-size: 25px;"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;

            addButton.insertAdjacentHTML('beforebegin', newQuestion);
            addButton.style.display = "none";
        });
    }); */

    const deckNameInput = document.querySelector('#deck-name');
    const deckDescriptionInput = document.querySelector('#message-text');

    function addDeck() {
        const deckName = document.querySelector('#deck-name').value;
        const deckDescription = document.querySelector('#message-text').value;

        const formData = new FormData();
        formData.append('name', deckName);
        formData.append('description', deckDescription);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/add-deck', {
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
                    deckNameInput.value = '';
                    deckDescriptionInput.value = '';
                } else if (data.errors) {
                    loadDeck();
                    console.error('Validation Errors:', data.errors);
                }
            })
            .catch(error => {
                console.error('Error:', error);
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
