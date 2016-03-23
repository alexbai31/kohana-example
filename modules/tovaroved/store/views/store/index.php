<ul>
    <?foreach ($stores as $store) {
    echo "<li><a href='".URL::base(TRUE, TRUE)."store/profile/$store->id'>$store->name</a></li>";
}
    ?>
</ul>
