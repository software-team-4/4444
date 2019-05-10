@extends('head-foot')
@section('contentRight')
<div class="right col-sm-9">
    <div class="right-content">
        <h2>Session information</h2>
        <div class="row">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td>Session name：</td>
                    <td>Basketball</td>
                </tr>
                <tr>
                    <td>
                        Session time：
                    </td>
                    <td>
                        Monday 8:00 - 10:00
                    </td>
                </tr>
                <tr>
                    <td>
                        Location
                    </td>
                    <td>
                        Basketball court
                    </td>
                </tr>
                <tr>
                    <td>
                        Coach：
                    </td>
                    <td>
                        YaoMing
                    </td>
                </tr>
                <tr>
                    <td>
                        Contact with coach：
                    </td>
                    <td>
                        13188888888
                    </td>
                </tr>
                <tr>
                    <td>More</td>
                    <td>
                        <button type="button"
                                class="btn btn-default" >
                            Editing
                        </button>
                        <button type="button"
                                class="btn btn-danger">
                            Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection