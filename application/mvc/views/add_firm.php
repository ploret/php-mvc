    <h2 id="add_firm">Add firm</h2>
    
    <div>
        <label>Name :</label>
        <input type="text" name="name" id="name" value="">
    </div>
    
    <div>
        <label>Phone :</label>
        <input type="text" name="phone" id="phone" value="">
    </div>
    
    <div>
        <label>Contact FIO :</label>
        <input type="text" name="fio" id="fio" value="">
    </div>
    
    <div>
        <label>Address :</label>
        <input type="text" name="address" id="address" value="">
    </div>
    
    <div>
        <label>Login :</label>
        <input type="text" name="login" id="login" value="">
    </div>
    
    <div>
        <label>Select city:</label>
        <select id="select_city">
            <?php if (isset($cities) && is_array($cities) && count($cities) > 0 ) { ?>
                <?php foreach ($cities as $city) { ?>
                     <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                <?php } ?>
            <?php } ?>
            
        </select>
        
    </div>
   
    
    <div id="div_submit">
        <input type="button" name="register" id="register" value="Register">
    </div>
    
    <h3 class="firm_incorrect_data" style="display: none">Incorrect data</h3>
    <h3 class="firm_success_register" style="display: none">Firm has been added successfully</h3>
