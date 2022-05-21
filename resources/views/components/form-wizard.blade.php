@push('head')
    <link rel="stylesheet" href="{{asset('plugins/stepper/bs-stepper.min.css')}}">
    <link rel="stylesheet" href="{{asset('themes/admin/css/form-validation.min.css')}}">
    <style>
        .bs-stepper {
            background-color: #fff;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
            border-radius: 0.5rem;
        }

        .bs-stepper .bs-stepper-header {
            padding: 1.5rem 1.5rem;
            flex-wrap: wrap;
            border-bottom: 1px solid rgba(34, 41, 47, 0.08);
            margin: 0;
        }

        .bs-stepper .bs-stepper-header .line {
            flex: 0;
            min-width: auto;
            min-height: auto;
            background-color: transparent;
            margin: 0;
            color: #6e6b7b;
            font-size: 1.5rem;
        }

        .bs-stepper .bs-stepper-header .step .step-trigger {
            padding: 0 1.75rem;
            flex-wrap: nowrap;
            font-weight: normal;
        }

        .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            padding: 0.5em 0;
            font-weight: 500;
            color: #babfc7;
            background-color: rgba(186, 191, 199, 0.12);
            border-radius: 0.35rem;
        }

        .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-label {
            text-align: left;
            margin: 0;
            margin-top: 0.5rem;
            margin-left: 1rem;
        }

        .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-label .bs-stepper-title {
            display: inherit;
            color: #6e6b7b;
            font-weight: 600;
            line-height: 1rem;
            margin-bottom: 0rem;
        }

        .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-label .bs-stepper-subtitle {
            font-weight: 400;
            font-size: 0.85rem;
            color: #b9b9c3;
        }

        .bs-stepper .bs-stepper-header .step .step-trigger:hover {
            background-color: transparent;
        }

        .bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-box {
            background-color: #007AAD;
            color: #fff;
            box-shadow: 0 3px 6px 0 rgba(115, 103, 240, 0.4);
        }

        .bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-label .bs-stepper-title {
            color: #007AAD;
        }

        .bs-stepper .bs-stepper-header .step.crossed .step-trigger .bs-stepper-box {
            background-color: rgba(115, 103, 240, 0.12);
            color: #007AAD !important;
        }

        .bs-stepper .bs-stepper-header .step.crossed .step-trigger .bs-stepper-label .bs-stepper-title {
            color: #b9b9c3;
        }

        .bs-stepper .bs-stepper-header .step.crossed + .line {
            color: #007AAD;
        }

        .bs-stepper .bs-stepper-header .step:first-child .step-trigger {
            padding-left: 0;
        }

        .bs-stepper .bs-stepper-header .step:last-child .step-trigger {
            padding-right: 0;
        }

        .bs-stepper .bs-stepper-content {
            padding: 1.5rem 1.5rem;
        }

        .bs-stepper .bs-stepper-content .content {
            margin-left: 0;
        }

        .bs-stepper .bs-stepper-content .content .content-header {
            margin-bottom: 1rem;
        }

        .bs-stepper.vertical .bs-stepper-header {
            border-right: 1px solid #ebe9f1;
            border-bottom: none;
        }

        .bs-stepper.vertical .bs-stepper-header .step .step-trigger {
            padding: 1rem 0;
        }

        .bs-stepper.vertical .bs-stepper-header .line {
            display: none;
        }

        .bs-stepper.vertical .bs-stepper-content {
            width: 100%;
            padding-top: 2.5rem;
        }

        .bs-stepper.vertical .bs-stepper-content .content:not(.active) {
            display: none;
        }

        .bs-stepper.vertical.wizard-icons .step {
            text-align: center;
        }

        .bs-stepper.wizard-modern {
            background-color: transparent;
            box-shadow: none;
        }

        .bs-stepper.wizard-modern .bs-stepper-header {
            border: none;
        }

        .bs-stepper.wizard-modern .bs-stepper-content {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
        }

        .horizontal-wizard,
        .vertical-wizard,
        .modern-horizontal-wizard,
        .modern-vertical-wizard {
            margin-bottom: 2.2rem;
        }

        .dark-layout .bs-stepper {
            background-color: #283046;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.24);
        }

        .dark-layout .bs-stepper .bs-stepper-header {
            border-bottom: 1px solid rgba(59, 66, 83, 0.08);
        }

        .dark-layout .bs-stepper .bs-stepper-header .line {
            color: #b4b7bd;
        }

        .dark-layout .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-box {
            color: #babfc7;
        }

        .dark-layout .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-label .bs-stepper-title {
            color: #b4b7bd;
        }

        .dark-layout .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-label .bs-stepper-subtitle {
            color: #676d7d;
        }

        .dark-layout .bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-box {
            background-color: #007AAD;
            color: #fff;
            box-shadow: 0 3px 6px 0 rgba(115, 103, 240, 0.4);
        }

        .dark-layout .bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-label .bs-stepper-title {
            color: #007AAD;
        }

        .dark-layout .bs-stepper .bs-stepper-header .step.crossed .step-trigger .bs-stepper-label,
        .dark-layout .bs-stepper .bs-stepper-header .step.crossed .step-trigger .bs-stepper-title {
            color: #676d7d;
        }

        .dark-layout .bs-stepper.vertical .bs-stepper-header {
            border-right-color: #3b4253;
        }

        .dark-layout .bs-stepper.wizard-modern {
            background-color: transparent;
            box-shadow: none;
        }

        .dark-layout .bs-stepper.wizard-modern .bs-stepper-header {
            border: none;
        }

        .dark-layout .bs-stepper.wizard-modern .bs-stepper-content {
            background-color: #283046;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.24);
        }

        html[data-textdirection='rtl'] .btn-prev,
        html[data-textdirection='rtl'] .btn-next {
            display: flex;
        }

        html[data-textdirection='rtl'] .btn-prev i,
        html[data-textdirection='rtl'] .btn-prev svg,
        html[data-textdirection='rtl'] .btn-next i,
        html[data-textdirection='rtl'] .btn-next svg {
            transform: rotate(-180deg);
        }

        @media (max-width: 740px) {
            .bs-stepper .bs-stepper-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .bs-stepper .bs-stepper-header .step .step-trigger {
                padding: 0.5rem 0 !important;
                flex-direction: row;
            }

            .bs-stepper .bs-stepper-header .line {
                display: none;
            }

            .bs-stepper.vertical {
                flex-direction: column;
            }

            .bs-stepper.vertical .bs-stepper-header {
                align-items: flex-start;
            }

            .bs-stepper.vertical .bs-stepper-content {
                padding-top: 1.5rem;
            }
        }
    </style>
@endpush

@push('footer')
    <script src="{{asset('plugins/stepper/bs-stepper.min.js')}}"></script>
    <script src="{{asset('themes/admin/js/form-validation.min.js')}}"></script>
@endpush
