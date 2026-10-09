
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Custom Links</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .header {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .back-btn {
            text-decoration: none;
            background: #111827;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
        }

        .container {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        }

        .card h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-row input {
            width: auto;
        }

        .submit-btn {
            border: none;
            background: #2563eb;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #1d4ed8;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error ul {
            margin: 0;
            padding-left: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 13px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background: #f9fafb;
            font-size: 14px;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .tab-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .new-tab {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .same-tab {
            background: #f3f4f6;
            color: #374151;
        }

        .action-btn {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            margin-right: 5px;
        }

        .edit-btn {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .delete-btn {
            background: #fee2e2;
            color: #b91c1c;
            border: none;
            cursor: pointer;
        }

        .link-preview {
            color: #2563eb;
            text-decoration: none;
        }

        .link-preview:hover {
            text-decoration: underline;
        }

        @media (max-width: 700px) {
            .header {
                padding: 16px 18px;
            }

            .header h1 {
                font-size: 20px;
            }

            .container {
                margin: 20px auto;
                padding: 0 12px;
            }

            .card {
                padding: 18px;
            }

            th,
            td {
                padding: 10px 8px;
            }
        }
    </style>
</head>

<body>

<div class="header">

    <h1>Custom Links</h1>

    <a href="{{ url('/dashboard') }}" class="back-btn">
        ← Dashboard
    </a>

</div>


<div class="container">

    {{-- Success Message --}}
    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Error Messages --}}
    @if ($errors->any())

        <div class="error">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Add New Link --}}
    <div class="card">

        <h2>Add New Link</h2>

        <form
            action="{{ route('admin.custom-links.store') }}"
            method="POST"
        >

            @csrf


            {{-- Link Name --}}
            <div class="form-group">

                <label for="name">
                    Link Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Example: Education Board"
                    value="{{ old('name') }}"
                    required
                >

            </div>


            {{-- URL --}}
            <div class="form-group">

                <label for="url">
                    URL
                </label>

                <input
                    type="url"
                    id="url"
                    name="url"
                    placeholder="https://example.com"
                    value="{{ old('url') }}"
                    required
                >

            </div>


            {{-- Icon --}}
            <div class="form-group">

                <label for="icon">
                    Icon
                </label>

                <input
                    type="text"
                    id="icon"
                    name="icon"
                    placeholder="🔗 or fa-link"
                    value="{{ old('icon') }}"
                >

            </div>


            {{-- Sort Order --}}
            <div class="form-group">

                <label for="sort_order">
                    Sort Order
                </label>

                <input
                    type="number"
                    id="sort_order"
                    name="sort_order"
                    min="0"
                    value="{{ old('sort_order', 0) }}"
                >

            </div>


            {{-- Active --}}
            <div class="form-group checkbox-row">

                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    {{ old('is_active', true) ? 'checked' : '' }}
                >

                <label
                    for="is_active"
                    style="margin: 0;"
                >
                    Active
                </label>

            </div>


            {{-- Open in New Tab --}}
            <div class="form-group checkbox-row">

                <input
                    type="checkbox"
                    id="open_in_new_tab"
                    name="open_in_new_tab"
                    value="1"
                    {{ old('open_in_new_tab') ? 'checked' : '' }}
                >

                <label
                    for="open_in_new_tab"
                    style="margin: 0;"
                >
                    Open in New Tab
                </label>

            </div>


            {{-- Submit --}}
            <button
                type="submit"
                class="submit-btn"
            >
                Add Link
            </button>

        </form>

    </div>


    {{-- Existing Links --}}
    <div class="card">

        <h2>Existing Links</h2>


        @if ($links->count())

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Icon
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                URL
                            </th>

                            <th>
                                Order
                            </th>

                            <th>
                                Open
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($links as $link)

                            <tr>

                                {{-- Icon --}}
                                <td>
                                    {{ $link->icon ?: '🔗' }}
                                </td>


                                {{-- Name --}}
                                <td>

                                    <strong>
                                        {{ $link->name }}
                                    </strong>

                                </td>


                                {{-- URL --}}
                                <td>

                                    <a
                                        href="{{ $link->url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="link-preview"
                                    >
                                        Open Link
                                    </a>

                                </td>


                                {{-- Sort Order --}}
                                <td>
                                    {{ $link->sort_order }}
                                </td>


                                {{-- Open Type --}}
                                <td>

                                    @if ($link->open_in_new_tab)

                                        <span class="tab-status new-tab">
                                            New Tab
                                        </span>

                                    @else

                                        <span class="tab-status same-tab">
                                            Same Tab
                                        </span>

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if ($link->is_active)

                                        <span class="status active">
                                            Active
                                        </span>

                                    @else

                                        <span class="status inactive">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <a
                                        href="{{ route('admin.custom-links.edit', $link) }}"
                                        class="action-btn edit-btn"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('admin.custom-links.destroy', $link) }}"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this link?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <p style="color:#6b7280;">
                No custom links added yet.
            </p>

        @endif

    </div>

</div>

</body>
</html>
