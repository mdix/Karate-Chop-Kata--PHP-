<?php
class Chopper {
    private $haystack = NULL;
    private $numElems = 0;
    private $shifted = 0;
    private $availableKeys = NULL;
    
    public function chopIterative($needle, $haystack) {
        // iterate
        foreach ($haystack as $key => $value) {
            if ($needle === $value) {
                // here it is
                return $key;
            }
        }
        // not found
        return -1;
    }

    // $haystack could be passed by reference, would it be better?
    public function chopRecursive($needle, $haystack) {
        if ($this->haystack === NULL) {
            $this->haystack = $haystack;
            $this->numElems = count($this->haystack);
        }

        $currentKey  = key($this->haystack);
        $curentValue = current($this->haystack);

        if ($curentValue === $needle) {
            // we've found that sucker, return its value
            return $currentKey;
        }
        
        if ($currentKey=== $this->numElems - 1) {
            // we ran out of elements - quit with -1
            return -1;
        }

        // naaah, nothing, next one please
        next($this->haystack);
        return $this->chopRecursive($needle, $this->haystack);
    }

    // IDGTS - why should this perform better???
    public function chopSlice($needle, $haystack) {
        $elemsHaystack      = count($haystack);
        $haystackLower      = array_slice($haystack, 0, $elemsHaystack / 2);
        $haystackUpper      = array_slice($haystack, $elemsHaystack / 2, $elemsHaystack);
        $elemsHaystackLower = count($haystackLower);

        // iterate lower slice
        foreach ($haystackLower as $key => $value) {
            if ($needle === $value) {
                // here it is
                return $key;
            }
        }
        // iterate upper slice
        foreach ($haystackUpper as $key => $value) {
            if ($needle === $value) {
                // add num count for lower array to return correct key for full array
                return $elemsHaystackLower + $key;
            }
        }

        // nothing found
        return -1;
    }

    // search from both sides via array_shift / array_pop
    public function chopFirstLastPop($needle, $haystack) {
        $this->haystack = $haystack;
        // we need to keep track about how often we shifted to return the correct position
        $this->shifted  = 0;
        $this->numElems = count($this->haystack);

        for ($i=0; $i < $this->numElems; $i++) {
            // even first
            if ($i & 1) {
                // set pointer to the end of haystack
		end ($this->haystack);
                // get number of key (last one)
                $elemsKey     = key($this->haystack);
                // remove last item and get value
                $currentValue = array_pop($this->haystack);

                if ($needle === $currentValue) {
                    // calculate position and return
                    return $elemsKey + $this->shifted;
                }

            // odd here
            } else {
                // set pointer to first element of haystack
                reset ($this->haystack);
                // remove first item and get the value
                $currentValue = array_shift($this->haystack);

                if ($needle === $currentValue) {
                    // return elems position (always first => 0)
                    return $this->shifted;
                }
                // not found, update var to maintain track of nr of shifts
	        $this->shifted++;
            }
        }

        // ran out of elements
        return -1;
    }

    // get available keys, mix them up and try until running out of keys
    public function chopRandom($needle, $haystack) {
        $this->haystack  = $haystack;
        // switch elems and keys
        $flippedHaystack = array_flip($haystack);
        // mix elems (former keys) up (randomize)
        shuffle($flippedHaystack);
        // save mixed up elems (former keys) to iterate over it
        $this->availableKeys = $flippedHaystack;

        foreach ($this->availableKeys as $haystackKey) {
             if ($needle === $this->haystack[$haystackKey]) {
                 // found the needle, return key
                 return $haystackKey;
             }
             // not found the needle, remove element and remove key
             // @question: should we remove the elements here? it's not necessary.
             unset($this->haystack[$haystackKey], $this->availableKeys[$haystackKey]);
        }
        return -1;
    }

}
?>