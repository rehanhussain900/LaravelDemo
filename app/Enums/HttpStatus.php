<?php

namespace App\Enums;


final class HttpStatus
{
    public const               Continue                           = 100;
    public const               witchingProtocols                  = 101;
    public const               Processing                         = 102;
    public const               EarlyHints                         = 103;
    public const               OK                                 = 200;
    public const               Created                            = 201;
    public const               Accepted                           = 202;
    public const               NonAuthoritativeInformation        = 203;
    public const               NoContent                          = 204;
    public const               ResetContent                       = 205;
    public const               PartialContent                     = 206;
    public const               MultipleChoices                    = 300;
    public const               MovedPermanently                   = 301;
    public const               Found                              = 302;
    public const               SeeOther                           = 303;
    public const               NotModified                        = 304;
    public const               UseProxy                           = 305;
    public const               Unused                             = 306;
    public const               TemporaryRedirect                  = 307;
    public const               PermanentRedirect                  = 308;
    public const               BadRequest                         = 400;
    public const               Unauthorized                       = 401;
    public const               PaymentRequired                    = 402;
    public const               Forbidden                          = 403;
    public const               NotFound                           = 404;
    public const               MethodNotAllowed                   = 405;
    public const               NotAcceptable                      = 406;
    public const               ProxyAuthenticationRequired        = 407;
    public const               RequestTimeout                     = 408;
    public const               Conflict                           = 409;
    public const               Gone                               = 410;
    public const               LengthRequired                     = 411;
    public const               PreconditionFailed                 = 412;
    public const               RequestEntityTooLarge              = 413;
    public const               RequestURITooLong                  = 414;
    public const               UnsupportedMediaType               = 415;
    public const               RequestedRangeNotSatisfiable       = 416;
    public const               ExpectationFailed                  = 417;
    public const               ImATeapot                          = 418;
    public const               MisdirectedRequest                 = 421;
    public const               UnprocessableEntity                = 422;
    public const               Locked                             = 423;
    public const               TooEarly                           = 425;
    public const               UpgradeRequired                    = 426;
    public const               PreconditionRequired               = 428;
    public const               TooManyRequests                    = 429;
    public const               RequestHeaderFieldsTooLarge        = 431;
    public const               UnavailableForLegalReasons         = 451;
    public const               InternalServerError                = 500;
    public const               NotImplemented                     = 501;
    public const               BadGateway                         = 502;
    public const               ServiceUnavailable                 = 503;
    public const               GatewayTimeout                     = 504;
    public const               HTTPVersionNotSupported            = 505;
    public const               VariantAlsoNegotiates              = 506;
    public const               InsufficientStorage                = 507;
    public const               NetworkAuthenticationRequired      = 511;
    public const               WebserverIsReturningAnUnknownError = 520;
    public const               ConnectionTimedOut                 = 522;
    public const               ATimeoutOccurred                   = 524;
}