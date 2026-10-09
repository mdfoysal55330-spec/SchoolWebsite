
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Custom Link</title>

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
            max-width: 800px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        }

        .card h2 {
            margin-top: 0;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
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

        .checkbox-row label {
            margin: 0;
        }

        .button-row {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .update-btn {
            border: none;
            background: #2563eb;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .update-btn:hover {
            background: #1d4ed8;
        }

        .cancel-btn {
            text-decoration: none;
            background: #e5e7eb;
            color: #374151;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
        }

        .cancel-btn:hover {
            background: #d1d5db;
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

        .current-link {
            margin-top: 8px;
            font-size: 13px;
            color: #6b7280;
        }

        .current-link a {
            color: #2563eb;
            text-decoration: none;
        }

        .current-link a:hover {
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

            .button-row {
                flex-direction: column;
            }

            .update-btn,
            .cancel-btn {
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="header">

    <h1>Edit Custom Link</h1>

    <a
        href="{{ route('admin.custom-links.index') }}"
        class="back-btn"
    >
        ← Custom Links
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


    <div class="card">

        <h2>
            Edit Link
        </h2>


        <form
            action="{{ route('admin.custom-links.update', $customLink) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            {{-- Link Name --}}
            <div class="form-group">

                <label for="name">
                    Link Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $customLink->name) }}"
                    placeholder="Example: Education Board"
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
                    value="{{ old('url', $customLink->url) }}"
                    placeholder="https://example.com"
                    required
                >

                <div class="current-link">

                    Current link:

                    <a
                        href="{{ $customLink->url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Open Link
                    </a>

                </div>

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
                    value="{{ old('icon', $customLink->icon) }}"
                    placeholder="🔗 or fa-link"
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
                    value="{{ old('sort_order', $customLink->sort_order) }}"
                >

            </div>


            {{-- Active --}}
            <div class="form-group checkbox-row">

                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $customLink->is_active) ? 'checked' : '' }}
                >

                <label for="is_active">
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
                    {{ old('open_in_new_tab', $customLink->open_in_new_tab) ? 'checked' : '' }}
                >

                <label for="open_in_new_tab">
                    Open in New Tab
                </label>

            </div>


            {{-- Buttons --}}
            <div class="button-row">

                <button
                    type="submit"
                    class="update-btn"
                >
                    Update Link
                </button>


                <a
                    href="{{ route('admin.custom-links.index') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>
