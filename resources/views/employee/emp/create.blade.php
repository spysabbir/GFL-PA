<div class="col-lg-6">
    <div class="form-group">
        <label class="form-label">Phone Number</label>
        <input type="email" class="form-control" name="phone_number" value="{{ old('phone_number') }}" placeholder="Enter your phone">
        @error('phone_number')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-control custom-select">
            <option value="">--Select Gender--</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <span class="text-danger error-text gender_error"></span>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-label">Date of Birth</label>
        <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
        <span class="text-danger error-text date_of_birth_error"></span>
    </div>
</div>
