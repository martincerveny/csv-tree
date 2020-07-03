@extends('master.layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mt-4">CSV tree structure</h1>
                @include('master.component.errors')
                @include('master.component.flash-messages')
                <div class="mt-4">
                    <h4 class="mt-4">Options</h4>
                    @if (\Request::is('tree/*'))
                        <a class="btn btn-primary mt-2" href="{{ route('tree.calculate', request()->route('id')) }}"
                           role="button">Calculate tree value</a>
                        <a class="btn btn-primary mt-2" href="{{ route('tree.move', request()->route('id')) }}"
                           role="button">Move subtree</a>
                    @endif
                    @if (\Request::is('/'))
                        <a class="btn btn-primary mt-2" href="{{ route('export.index') }}" role="button">Export to CSV</a>
                    @endif
                </div>
                @if(isset($result))
                    <div class="mt-2">
                        <h4 class="mt-4">Result: {{ $result }}</h4>
                    </div>
                @endif
                @if (\Request::is('*/move'))
                    <div class="mt-4">
                        <form method="post" action="{{ route('tree.changeParent', request()->route('id')) }}">
                            @CSRF
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="parent_id">New parent ID</label>
                                    <input required type="number" class="form-control" name="parent_id" id="parent_id"
                                           placeholder="Parent ID">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                @endif
                <div class="mt-5">
                    @php
                        function printTree($tree) {
                            echo '<ul>';
                            foreach ($tree as $item) {
                                echo '<li>';
                                echo '<a href=" ' . route('tree.show', $item['id']) . ' ">' . $item['identifier'] . '</a>';
                                if (isset($item['children'])) {
                                    printTree($item['children']);
                                }
                                echo '</li>';
                            }
                            echo '</ul>';
                        }

                    printTree($tree);
                    @endphp
                </div>
            </div>
        </div>
    </div>
@endsection
