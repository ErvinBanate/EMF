function newProductForm() {
    const form = `<div class="border p-4">
        <h3 class="text-center">New Product</h3>
        <form class="row g-3" action="" method="POST">
            <div class="col-md-5">
                <label class="form-label" for="input-new-product">Product Name</label>
                <input class="form-control" type="text" name="input-new-product">
            </div>

            <div class="col-md-5">
                <label class="form-label" for="input-new-quantity">Quantity</label>
                <input class="form-control" type="text" name="input-new-quantity">

            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>`;


    document.getElementById('showSelectedFunction').innerHTML = form;
}

function addRemoveQuantityForm() {
    const form = `<div class="row justify-content-around">
        <div class="col-5 border p-4">
            <h3 class="text-center">Add Product Stock</h3>
            <form class="row g-3" action="" method="POST">
                <div class="col-md-4">
                    <label class="form-label" for="input-new-product">Product Name</label>
                    <input class="form-control" type="text" name="input-new-product">
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="input-new-quantity">Quantity</label>
                    <input class="form-control" type="text" name="input-new-quantity">

                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>

        <div class="col-5 border p-4">
            <h3 class="text-center">Remove Product Stock</h3>
            <form class="row g-3" action="" method="POST">
                <div class="col-md-4">
                    <label class="form-label" for="input-new-product">Product Name</label>
                    <input class="form-control" type="text" name="input-new-product">
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="input-new-quantity">Quantity</label>
                    <input class="form-control" type="text" name="input-new-quantity">

                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>`;

    document.getElementById('showSelectedFunction').innerHTML = form;
}

function removeProduct() {
    const form = `<div class="border p-4 ">
        <h3 class="text-center">Remove Product</h3>
        <form class="row g-3 justify-content-center" action="" method="POST">
            <div class="col-md-5">
                <label class="form-label" for="input-new-product">Product Name</label>
                <input class="form-control" type="text" name="input-new-product">
            </div>


            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>`;

    document.getElementById('showSelectedFunction').innerHTML = form;
}