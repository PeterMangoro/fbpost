<div class="enquiry-form-container">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="post" action="{{route('sent-email','$development->agency->id')}}">
        @csrf

        <div class="row ">

            <h3 class="pt-4 ">Send Email</h3>
            <div class=" col-md-12 mt-3 ">

                <label for="name" class="form-label mb-1">
                    Your Name*</label
                >
                <input
                    id="name"
                    type="text"
                    class="form-control name"
                    name="name"
                    value=""
                    required
                />
                @error('name')
                <div class="alert alert-danger mt-1 p-2">{{ $message }}</div>
                @enderror
            </div>
            <div class=" col-md-12">
                <label for="surname" class="form-label mb-1 pt-4">
                    Email Address*</label
                >
                <input
                    id="email"
                    type="email"
                    class="form-control surname"
                    name="email"
                    value=""
                    required
                />
                @error('email')
                <div class="alert alert-danger mt-1 p-2">{{ $message }}</div>
                @enderror
            </div>
            <div class=" col-md-12">
                <label for="phoneNumber" class="form-label mb-1 pt-4">
                    Phone Number*</label
                >
                <input
                    id="phone"
                    type="text"
                    class="form-control phoneNumber"
                    name="phone"
                    value=""
                    required
                />
                @error('phone')
                <div class="alert alert-danger mt-1 p-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="email-message" class="form-label mb-1 pt-4"
                >Message*</label
                >
                <textarea
                    id="message"
                    class="form-control message"
                    name="message"
                    rows="8"
                    required
                >
                    </textarea>
                @error('message')
                <div class="alert alert-danger mt-1 p-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 my-3">
            <button

                id="sendRequestBtn"
                class="btn btn-dark w-100"
                type="submit"
            >
                    <span id="sendText">
                      SEND EMAIL
                    </span>

            </button>

        </div>
    </form>
</div>
