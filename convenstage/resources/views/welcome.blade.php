@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="img-fluid">
                    <img src="{{ asset('Bootstrap_logo.png') }}" width="100%">
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h3>Bienvenue sur ConvenStage</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Accusamus, aliquam, atque, autem beatae blanditiis consequuntur corporis cumque debitis
                            dignissimos doloremque dolores dolorum eaque eius enim error esse et eveniet facilis
                            fuga fugit harum hic id illo impedit in inventore ipsa ipsum iste itaque iure laboriosam
                            laudantium libero magni maxime molestiae nam natus necessitatibus nemo neque nihil
                            nostrum numquam odio officia omnis optio pariatur perferendis perspiciatis placeat
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
