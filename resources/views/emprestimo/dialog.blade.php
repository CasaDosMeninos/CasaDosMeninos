<form action="{{ action('EmprestimoController@store') }}" method="POST" class="form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{ $livro->id }}">
    <fieldset>

        <div class="formRow">
            <label>Data de devolução:</label>
            <div class="formRight">
                <div class="datepicker"></div>
                <input type="hidden" class="hidDatePicker" name="data">
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>Observações:</label>
            <div class="formRight">
                <textarea name="obs" rows="4"></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formSubmit"><input type="submit" value="Enviar" class="blueB" /></div>

    </fieldset>
</form>