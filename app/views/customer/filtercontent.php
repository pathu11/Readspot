<?php 
if(isset($data['searchResults']) && !empty($data['searchResults'])){
    foreach($data['searchResults'] as $searchResult): 
        // Get the book details and search query
        $topic = $searchResult->topic;
        $text = $searchResult->text;
        $search_query = $_POST['query'];
        
        // Use preg_replace to replace the search query with the same query wrapped in <strong> tags for book name, author, and ISBN number
        $highlighted_topic = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<strong>$1</strong>', $topic);
        $highlighted_text = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<strong>$1</strong>', $text);
        // Output the filtered book with highlighted search query
        echo '<div class="filter-book-N">';
                if($data['bookType']=='C'){
                    echo '<img src="' . URLROOT . '/assets/images/landing/addContents/' .  $searchResult->img . '" alt="img1" class="filter-img">';
                }
                echo '<a href="' . URLROOT . '/customer/viewcontent/' . $searchResult->content_id . '">' . $highlighted_topic . '</a><br>
                <p><label>Author:</label> ' . $highlighted_text . '</p>
              </div><hr>';
    endforeach;
}
else{
    if(isset($_POST['query'])) {
        echo '<p>No Results Found</p>';
    }
}
?>