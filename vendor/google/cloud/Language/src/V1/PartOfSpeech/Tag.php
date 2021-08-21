<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/language/v1/language_service.proto

namespace Google\Cloud\Language\V1\PartOfSpeech;

use UnexpectedValueException;

/**
 * The part of speech tags enum.
 *
 * Protobuf type <code>google.cloud.language.v1.PartOfSpeech.Tag</code>
 */
class Tag
{
    /**
     * Unknown
     *
     * Generated from protobuf enum <code>UNKNOWN = 0;</code>
     */
    const UNKNOWN = 0;
    /**
     * Adjective
     *
     * Generated from protobuf enum <code>ADJ = 1;</code>
     */
    const ADJ = 1;
    /**
     * Adposition (preposition and postposition)
     *
     * Generated from protobuf enum <code>ADP = 2;</code>
     */
    const ADP = 2;
    /**
     * Adverb
     *
     * Generated from protobuf enum <code>ADV = 3;</code>
     */
    const ADV = 3;
    /**
     * Conjunction
     *
     * Generated from protobuf enum <code>CONJ = 4;</code>
     */
    const CONJ = 4;
    /**
     * Determiner
     *
     * Generated from protobuf enum <code>DET = 5;</code>
     */
    const DET = 5;
    /**
     * Noun (common and proper)
     *
     * Generated from protobuf enum <code>NOUN = 6;</code>
     */
    const NOUN = 6;
    /**
     * Cardinal number
     *
     * Generated from protobuf enum <code>NUM = 7;</code>
     */
    const NUM = 7;
    /**
     * Pronoun
     *
     * Generated from protobuf enum <code>PRON = 8;</code>
     */
    const PRON = 8;
    /**
     * Particle or other function word
     *
     * Generated from protobuf enum <code>PRT = 9;</code>
     */
    const PRT = 9;
    /**
     * Punctuation
     *
     * Generated from protobuf enum <code>PUNCT = 10;</code>
     */
    const PUNCT = 10;
    /**
     * Verb (all tenses and modes)
     *
     * Generated from protobuf enum <code>VERB = 11;</code>
     */
    const VERB = 11;
    /**
     * Other: foreign words, typos, abbreviations
     *
     * Generated from protobuf enum <code>X = 12;</code>
     */
    const X = 12;
    /**
     * Affix
     *
     * Generated from protobuf enum <code>AFFIX = 13;</code>
     */
    const AFFIX = 13;

    private static $valueToName = [
        self::UNKNOWN => 'UNKNOWN',
        self::ADJ => 'ADJ',
        self::ADP => 'ADP',
        self::ADV => 'ADV',
        self::CONJ => 'CONJ',
        self::DET => 'DET',
        self::NOUN => 'NOUN',
        self::NUM => 'NUM',
        self::PRON => 'PRON',
        self::PRT => 'PRT',
        self::PUNCT => 'PUNCT',
        self::VERB => 'VERB',
        self::X => 'X',
        self::AFFIX => 'AFFIX',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Tag::class, \Google\Cloud\Language\V1\PartOfSpeech_Tag::class);

