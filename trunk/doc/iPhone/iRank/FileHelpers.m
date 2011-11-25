//
//  FileHelpers.m
//  Homepwner
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#include <stdio.h>
#import "FileHelpers.h"

NSString *pathInDocumentDirectory(NSString *fileName) {
    
    // Get list of document directories in sandbox
    NSArray *documentDirectories = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
    
    // Get one and only document directory from that list
    NSString *documentDirectory = [documentDirectories objectAtIndex:0];
    
    // apend passed in file name to that directory, return it
    return [documentDirectory stringByAppendingPathComponent:fileName];
}