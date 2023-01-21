<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User</h3>
                <p class="text-subtitle text-muted">User page.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Example Content</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('users.update', ['user' => $user->getId()])}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="username" class="form-control" name="name" id="username" aria-describedby="name" placeholder="name" value="{{$user->getName()}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="username" class="form-control" name="username" id="username" aria-describedby="username" placeholder="Username" value="{{$user->getUsername()}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{$user->getEmail()}}">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Role</label>
                        <select class="form-select" aria-label="Default select example" name="scope_id">
                            @foreach ($scopes as $scope)
                                @if($scope->getId() == $user->getScope()->getId())
                                <option selected value="{{$scope->getId()}}">{{$scope->getRole()}}</option>
                                @else
                                <option  value="{{$scope->getId()}}">{{$scope->getRole()}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>