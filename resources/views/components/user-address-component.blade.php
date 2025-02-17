<div class="dashboard-address">
    <div class="title title-flex">
        <div>
            <h2>My Address Book</h2>
            <span class="title-leaf">
                <svg class="icon-width bg-gray">
                    <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                    </use>
                </svg>
            </span>
        </div>

        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3" data-bs-toggle="modal"
                data-bs-target="#editProfile"><i data-feather="plus" class="me-2"></i> Add New Address

        </button>
    </div>

    <div class="row g-sm-4 g-3">
        <div class="col-md-6">
            <div class="address-box">
                @isset($address)
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jack" id="flexRadioDefault2" checked>
                        </div>

                        <div class="table-responsive address-table">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>

                                <tr>
                                    <td>
                                        {{ $address->address }}
                                    </td>
                                    <td>
                                        <p>
                                            {{ $address->state }} {{ $address->city }}
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Pin Code :</td>
                                    <td>{{ $address->pin_code }}</td>
                                </tr>

                                <tr>
                                    <td>Phone :</td>
                                    <td>
                                        {{ $address->phone }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="button-group">
                        <button class="btn btn-sm  w-100" id="edit-address-button" data-bs-toggle="modal"
                                data-id="{{ $address->id }}" data-bs-target="#editProfile"><i data-feather="edit"></i>
                            Edit
                        </button>
                    </div>
                @else
                    No Address Found
                @endisset
            </div>
        </div>


    </div>


</div>

