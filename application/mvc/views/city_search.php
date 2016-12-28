    <h2 id="city_search">Search firms and services by city</h2>

    
 
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
   
    <div id="div_service_search">
        <input type="button" name="search" id="search" value="Search">
    </div>
    
    <h3 class="incorrect_login" style="display: none">Incorrect login</h3>
    <h3 class="city_no_results" style="display: none">No results</h3>
    <div id="search_results"></div>
