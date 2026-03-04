<h2>Add Product</h2>

<form method="POST" action="/products/store" enctype="multipart/form-data">

    @csrf

    Name:
    <input type="text" name="name"><br><br>

    Price:
    <input type="text" name="price"><br><br>

    Description:
    <input type="text" name="description"><br><br>

    Image:
    <input type="file" name="image"><br><br>

    <button type="submit">Save</button>

</form>
