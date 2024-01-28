<?php 
if(isset($data['searchResults']) && !empty($data['searchResults'])){
    foreach($data['searchResults'] as $searchResult): 
        echo '<div class=filter-book-N>
        <img src="' . URLROOT . '/assets/images/publisher/addbooks/' .  $searchResult->img1 . '" alt="img1" class="filter-img">
        <a href="'.URLROOT.'/customer/BookDetails/'.$searchResult->book_id.'">'.$searchResult->book_name.'</a><br>
        <p>'.$searchResult->author.'</p>
        </div>';
    endforeach;
}
else{
    if(isset($_POST['query'])) {
        echo '<p>No Results Found</p>';
    }
}
?>


<!--script>
    function toggleDropdownfilter(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle("show-filter");
    }
</script>