@extends('head-foot')
@section('contentRight')
<div class="right col-sm-9">
    <div class="right-content">
        <h2>Facilities information</h2>
        <div class="row">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td>Facility name：</td>
                    <td>Swimming pool</td>
                </tr>
                <tr>
                    <td>
                        Opening time：
                    </td>
                    <td>
                        9:00 - 18:00
                    </td>
                </tr>
                <tr>
                    <td>
                        Bookable status
                    </td>
                    <td>
                        <p class="text-success">Bookable</p>
                        <p class="text-danger">unavailable</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        Price：
                    </td>
                    <td>
                        10 pound/hour
                    </td>
                </tr>
                <tr>
                    <td>
                        Maximum number：
                    </td>
                    <td>
                        20 people
                    </td>
                </tr>
                <tr>
                    <td>More</td>
                    <td>
                        <button type="button"
                                class="btn btn-success">
                            booking now
                        </button>
                        <button type="button"
                                class="btn btn-default">
                            Edit facility
                        </button>
                        <button type="button"
                                class="btn btn-warning">
                            No booking
                        </button>
                        <button type="button"
                                class="btn btn-danger">
                            Delete Facility
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection