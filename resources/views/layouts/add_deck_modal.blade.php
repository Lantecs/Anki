@extends('layouts.default')


<div class="modal fade" id="add_deck_modal" tabindex="-1" aria-labelledby="add_deck_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center" style="">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adding New Deck</h1>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-3">
                        <label for="deck-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="deck-name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label" >Description:</label>
                        <textarea class="form-control" id="message-text" maxlength="150" style="height: 150px;"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label">Questions:</label>
                        <div class="">

                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>


<style>
    .modal-header {
        font-family: "Poppins", sans-serif;
    }

    .modal-title {
        color: #4671Ea;
        font-size: 28px;
        text-align: center;
    }
</style>
