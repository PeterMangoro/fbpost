<div class="enquiry-form-container">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="post" action="{{route('linkedin.post')}}">
        @csrf

        <div class="row p-4 ">

            <h3 class=" ">Create Your LinkedIn Post </h3>


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
                ></textarea>
                @error('message')
                <div class="alert alert-danger mt-1 p-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="email-message" class="form-label mb-1 pt-4"
                >Link*</label
                >
                <input
                    id="link"
                    class="form-control message"
                    name="link"

                    required
                >
                </input>
                @error('link')
                <div class="alert alert-danger mt-1 p-2">{{ $link }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 my-3 ps-4 pe-4">
            <button

                id="sendRequestBtn"
                class="btn btn-dark w-100"
                type="submit"
            >
                    <span id="sendText">
                      POST
                    </span>

            </button>

        </div>
    </form>
</div>
