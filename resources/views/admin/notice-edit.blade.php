
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Notice</title>

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
            max-width: 850px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;
        }

        .current-file {
            margin-top: 10px;
            padding: 12px;
            background: #f3f4f6;
            border-radius: 8px;
            font-size: 14px;
        }

        .current-file a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
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
            width: 100%;
            border: none;
            background: #2563eb;
            color: white;
            padding: 13px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #1d4ed8;
        }

        .error-box {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>Edit Notice</h1>

    <a href="{{ route('admin.notices.index') }}" class="back-btn">
        ← Back to Notices
    </a>
</div>

<div class="container">

    <div class="card">

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.notices.update', $notice) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Notice Title</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $notice->title) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="type">Notice Type</label>

                <select
                    id="type"
                    name="type"
                    onchange="toggleNoticeFields()"
                    required
                >
                    <option value="image"
                        {{ old('type', $notice->type) === 'image' ? 'selected' : '' }}>
                        Image
                    </option>

                    <option value="pdf"
                        {{ old('type', $notice->type) === 'pdf' ? 'selected' : '' }}>
                        PDF
                    </option>

                    <option value="link"
                        {{ old('type', $notice->type) === 'link' ? 'selected' : '' }}>
                        External Link
                    </option>
                </select>
            </div>

            <div class="form-group" id="fileField">

                <label for="file">
                    Replace File
                </label>

                <input
                    type="file"
                    id="file"
                    name="file"
                    accept=".jpg,.jpeg,.png,.webp,.pdf"
                >

                @if ($notice->file_path)
                    <div class="current-file">
                        Current File:
                        <a
                            href="{{ asset($notice->file_path) }}"
                            target="_blank"
                        >
                            View Current File
                        </a>
                    </div>
                @endif

            </div>

            <div class="form-group" id="urlField">

                <label for="external_url">
                    External URL
                </label>

                <input
                    type="url"
                    id="external_url"
                    name="external_url"
                    value="{{ old('external_url', $notice->external_url) }}"
                    placeholder="https://example.com"
                >
            </div>

            <div class="form-group">

                <label for="publish_date">
                    Publish Date
                </label>

                <input
                    type="date"
                    id="publish_date"
                    name="publish_date"
                    value="{{ old('publish_date', \Carbon\Carbon::parse($notice->publish_date)->format('Y-m-d')) }}"
                    required
                >
            </div>

            <div class="form-group checkbox-row">

                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $notice->is_active) ? 'checked' : '' }}
                >

                <label for="is_active" style="margin: 0;">
                    Active Notice
                </label>

            </div>

            <button type="submit" class="submit-btn">
                Update Notice
            </button>

        </form>

    </div>

</div>

<script>
    function toggleNoticeFields() {

        const type = document.getElementById('type').value;

        const fileField = document.getElementById('fileField');
        const urlField = document.getElementById('urlField');

        if (type === 'link') {
            fileField.style.display = 'none';
            urlField.style.display = 'block';
        } else {
            fileField.style.display = 'block';
            urlField.style.display = 'none';
        }
    }

    toggleNoticeFields();
</script>

</body>
</html>
