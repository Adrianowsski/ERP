<div class="mb-3">
    <label class="form-label" for="name">
        <i data-feather="truck" class="me-1"></i>Name
    </label>
    <input
        type="text"
        name="name"
        id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $supplier->name ?? '') }}"
        required
    >
    @error('name')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="nip">
        <i data-feather="credit-card" class="me-1"></i>NIP
    </label>
    <input
        type="text"
        name="nip"
        id="nip"
        class="form-control @error('nip') is-invalid @enderror"
        value="{{ old('nip', $supplier->nip ?? '') }}"
        required
    >
    @error('nip')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="email">
        <i data-feather="mail" class="me-1"></i>Email
    </label>
    <input
        type="email"
        name="email"
        id="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $supplier->email ?? '') }}"
        required
    >
    @error('email')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="phone">
        <i data-feather="phone" class="me-1"></i>Phone
    </label>
    <input
        type="text"
        name="phone"
        id="phone"
        class="form-control @error('phone') is-invalid @enderror"
        value="{{ old('phone', $supplier->phone ?? '') }}"
        required
    >
    @error('phone')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="address">
        <i data-feather="map-pin" class="me-1"></i>Address
    </label>
    <textarea
        name="address"
        id="address"
        rows="3"
        class="form-control @error('address') is-invalid @enderror"
        required
    >{{ old('address', $supplier->address ?? '') }}</textarea>
    @error('address')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
