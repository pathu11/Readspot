<?php 
if(isset($data['searchResults']) && !empty($data['searchResults'])){
    foreach($data['searchResults'] as $searchResult): 
        // Get the book details and search query
        $book_name = $searchResult->book_name;
        $author = $searchResult->author;
        $ISBN_no = $searchResult->ISBN_no;
        $search_query = $_POST['query'];
        
        // Use preg_replace to replace the search query with the same query wrapped in <strong> tags for book name, author, and ISBN number
        $highlighted_book_name = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<strong>$1</strong>', $book_name);
        $highlighted_author = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<strong>$1</strong>', $author);
        $highlighted_ISBN_no = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<strong>$1</strong>', $ISBN_no);
        
        // Output the filtered book with highlighted search query
        echo '<div class="filter-book-N">';
                if($data['bookType']=='N'){
                    echo '<img src="' . URLROOT . '/assets/images/publisher/addbooks/' .  $searchResult->img1 . '" alt="img1" class="filter-img">';
                    echo '<a href="' . URLROOT . '/customer/BookDetails/' . $searchResult->book_id . '">' . $highlighted_book_name . '<br>
                        <p><label>Author:</label> ' . $highlighted_author . '</p>
                        <p><label>ISBN:</label> ' . $highlighted_ISBN_no . '</p>
                        <p>Rs.' . $searchResult->price . '</p></a>
                    </div><hr>';
                }
                if($data['bookType']=='U'){
                    echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $searchResult->img1 . '" alt="img1" class="filter-img">';
                    echo '<a href="' . URLROOT . '/customer/UsedBookDetails/' . $searchResult->book_id . '">' . $highlighted_book_name . '<br>
                        <p><label>Author:</label> ' . $highlighted_author . '</p>
                        <p><label>ISBN:</label> ' . $highlighted_ISBN_no . '</p>
                        <p>Rs.' . $searchResult->price . '</p></a>
                    </div><hr>';
                }

                if($data['bookType']=='E'){
                    echo '<img src="' . URLROOT . '/assets/images/customer/AddExchangeBook/' .  $searchResult->img1 . '" alt="img1" class="filter-img">';
                    echo '<a href="' . URLROOT . '/customer/ExchangeBookDetails/' . $searchResult->book_id . '">' . $highlighted_book_name . '<br>
                        <p><label>Author:</label> ' . $highlighted_author . '</p>
                        <p><label>ISBN:</label> ' . $highlighted_ISBN_no . '</p>
                        <p>Rs.' . $searchResult->price . '</p></a>
                    </div><hr>';
                }

            //     echo '<a href="' . URLROOT . '/customer/BookDetails/' . $searchResult->book_id . '">' . $highlighted_book_name . '</a><br>
            //     <p><label>Author:</label> ' . $highlighted_author . '</p>
            //     <p><label>ISBN:</label> ' . $highlighted_ISBN_no . '</p>
            //     <p>Rs.' . $searchResult->price . '</p>
            //   </div><hr>';
    endforeach;
}
else{
    if(isset($_POST['query'])) {
        echo '<p>No Results Found</p>';
    }
}
?>