    <h2 id="add_service">Add service</h2>
    
    <div>
        <label>Name :</label>
        <input type="text" name="name" id="name" value="">
    </div>
    
    <div>
        <label>Description :</label>
        <input type="text" name="description" id="description" value="">
    </div>
    
    <div>
        <label>Profit (UAH) :</label>
        <input type="text" name="profit" id="profit" value="">
    </div>
    
    <div>
        <label>Firm name:</label>
        <select id="select_firm">
            <?php if (isset($firms) && is_array($firms) && count($firms) > 0 ) { ?>
                <?php foreach ($firms as $firm) { ?>
                     <option value="<?php echo $firm['id']; ?>"><?php echo $firm['name']; ?></option>
                <?php } ?>
            <?php } ?>
            
        </select>
        
    </div>
   
    
    <div id="div_submit">
        <input type="button" name="register" id="register" value="Register">
    </div>
    
    <h3 class="service_incorrect_data" style="display: none">Incorrect data</h3>
    <h3 class="service_success_register" style="display: none">Service has been added successfully</h3>
