@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="data-table ">
            <section class="actions">
                <div class="actions-inner">
                    <div class="frame-parent">
                        <div class="frame-wrapper">
                            <div class="button-parent">
                                <div class="input-wrapper">
                                    <form class="input" action="{{ route('tasks.index') }}" method="GET">
                                        <div class="search-wrapper">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </div>
                                        <input style="box-shadow: none;" class="search" name="search"
                                            value="{{ old('search') }}" placeholder="Search..."type="text" />
                                    </form>
                                </div>
                                <button type="button" class="button-add btn" onclick="add()">
                                    <i class="fa-solid fa-plus fs-6"></i>
                                </button>
                            </div>
                        </div>
                        <div class="header">
                            <div class="column-header">
                                <div class="name">ID</div>
                            </div>
                            <div class="column-header1">
                                <a class="name1">Name</a>
                            </div>
                            <div class="column-header2">
                                <a class="name2">content</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @if ($tasks->total() == 0)
                <h5 class="mt-5 text-center w-100">
                    <span>No result is found</span>
                    <p>Please search for other keywords</p>
                </h5>
            @else
                @foreach ($tasks as $task)
                    <div class="customer">
                        <div class="customer-checkbox-row">
                            <div class="empty-column">{{ $task->id }}</div>
                        </div>
                        <div class="description-row">
                            <div class="kadin-herwitz">{{ $task->name }}</div>
                        </div>
                        <div class="lorem-ipsum-dolor-sit-amet-co-parent">
                            <div class="lorem-ipsum-dolor">
                                {{ $task->content }}
                            </div>
                        </div>
                        <div class="empty-column-group">
                            <button href="#" class="btn button-update">
                                <i class="fa-solid fa-pen-to-square fs-6"></i>
                            </button>
                            <button class="btn button-delete">
                                <i class="fa-solid fa-trash-can fs-6"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="w-100">
            {{ $tasks->appends(['search' => $search])->links() }}
        </div>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="taskModal">Create a new task</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="taskForm" name="taskForm" class="form-horizontal" method="POST">
                        @csrf
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul style="padding: 0"></ul>
                        </div>
                        <input type="hidden" id="task_id" name="id" class="form-control">
                        <div class="mb-3">
                            <label class="col-form-label">Name <span class="essential">*</span></label>
                            <input type="text" id="task_name" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Content <span class="essential">*</span></label>
                            <input type="text" id="task_content" name="content" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
