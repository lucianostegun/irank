//
//  RankingDetailViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "iRankAppDelegate.h"
#import "RankingDetailViewController.h"
#import "Ranking.h"
#import "ELCTextfieldCell.h"
#import "Constants.h"

@implementation RankingDetailViewController

@synthesize ranking;
@synthesize datePicker;
@synthesize pickerView;
@synthesize pickerOptionList;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:UITableViewStyleGrouped];
    if (self) {
        // Custom initialization
    }
    
    return self;
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];

    pickerOptionList = [[NSMutableArray alloc] init];
    
    NSMutableArray *gameStyleList = [[NSMutableArray alloc] init];
    [gameStyleList addObject:@"Torneio"];
    [gameStyleList addObject:@"Ring game"];
    [gameStyleList addObject:@"Sit & Go"];
    
    NSMutableArray *rankingTypeList = [[NSMutableArray alloc] init];
    [rankingTypeList addObject:@"Balanço"];
    [rankingTypeList addObject:@"Ganhos"];
    [rankingTypeList addObject:@"Média"];
    [rankingTypeList addObject:@"Pontos"];
    
    [pickerOptionList addObject:gameStyleList];
    [pickerOptionList addObject:rankingTypeList];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];
    
    [self.tableView reloadData];
    NSLog(@"viewWillAppear");
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated
{
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{

    return 2;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    int rows;
    
    if( section==0 )
        rows = 8;
    else
        rows = 4;
    
    return rows;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"Cell";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    NSString *label;
    NSString *value;
    
    if( indexPath.section==0 ){
        
        switch (indexPath.row) {
            case 0:
                label = @"Nome";
                value = ranking.rankingName;
                break;
            case 1:
                label = @"Crédito";
                value = ranking.credit;
                break;
            case 2:
                label = @"Estilo";
                value = ranking.gameStyle;
                break;
            case 3:
                label = @"Início";
                value = ranking.startDate;
                break;
            case 4:
                label = @"Término";
                value = ranking.finishDate;
                break;
            case 5:
                label = @"Exibição";
                value = ([ranking.isPrivate isEqualToString:@"1"]?@"Privado":@"Público");
                break;
            case 6:
                label = @"Classificação";
                value = ranking.rankingType;
                break;
            case 7:
                label = @"Buy-in padrão";
                value = ranking.defaultBuyin;
                break;
            default:
                break;
        }
    }else{        
        switch (indexPath.row) {
            case 0:
                label = @"Jogadores";
                break;
            case 1:
                label = @"Eventos";
                break;
            case 2:
                label = @"Classificação";
                break;
            case 3:
                label = @"Opções";
            default:
                break;
        }
    }    
    
    if( indexPath.section==0 ){
        
        ELCTextfieldCell *cell = (ELCTextfieldCell*)[tableView dequeueReusableCellWithIdentifier:CellIdentifier];
        cell = [[[ELCTextfieldCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];

        cell.leftLabel.text      = label;
        cell.rightTextField.text = value;
        
        if( indexPath.row==1 || indexPath.row==2 || indexPath.row==6 ){
            
            cell.rightTextField.enabled = NO;
            
            if( indexPath.row==2 || indexPath.row==6 )
                [cell.rightTextField addTarget:self action:@selector(textFieldTouchUp:) forControlEvents:UIControlEventTouchDown];
        }


        cell.selectionStyle = UITableViewCellEditingStyleNone;

        
//             [choiceBarSegmentedControl addTarget:self action:@
//              selector(selectTransportation:) forControlEven
//                                               ts:UIControlEventValueChanged];
//        }

        
        
        cell.accessoryType = UITableViewCellAccessoryNone;
        cell.rightTextField.delegate = self;
        
        return cell;
    }else{
        
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleValue1 reuseIdentifier:CellIdentifier] autorelease];        
        cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
        
        cell.textLabel.text = label;
        
        return cell;
    }
    
    return cell;
}

- (NSString *)tableView:(UITableView *)tableView 
titleForHeaderInSection:(NSInteger)section {
    
    NSString *title = nil;
    
    switch (section) {
        case 0:
            title = @"Informações principais";
            break;
        case 1:
            title = @"Informações adicionais";
            break;
        default:
            break;
    }
    
    return title;
}

/*
// Override to support conditional editing of the table view.
- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the specified item to be editable.
    return YES;
}
*/

/*
// Override to support editing the table view.
- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
{
    if (editingStyle == UITableViewCellEditingStyleDelete) {
        // Delete the row from the data source
        [tableView deleteRowsAtIndexPaths:[NSArray arrayWithObject:indexPath] withRowAnimation:UITableViewRowAnimationFade];
    }   
    else if (editingStyle == UITableViewCellEditingStyleInsert) {
        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
    }   
}
*/

/*
// Override to support rearranging the table view.
- (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
{
}
*/

/*
// Override to support conditional rearranging of the table view.
- (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the item to be re-orderable.
    return YES;
}
*/

#pragma mark - Table view delegate

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{

    NSLog(@"didSelectRowAtIndexPath");
    
//    if (self.datePicker == nil){
//      
//        self.datePicker = [[UIDatePicker alloc] init];
//    
//        [self.navigationController.view.window addSubview: self.datePicker];
//		
//		// size up the picker view to our screen and compute the start/end frame origin for our slide up animation
//		//
//		// compute the start frame
//		CGRect screenRect = [[UIScreen mainScreen] applicationFrame];
//		CGSize pickerSize = [datePicker sizeThatFits:CGSizeZero];
//		CGRect startRect = CGRectMake(0.0,
//									  screenRect.origin.y + screenRect.size.height,
//									  pickerSize.width, pickerSize.height);
//		self.datePicker.frame = startRect;
//		
//		// compute the end frame
//		CGRect pickerRect = CGRectMake(0.0,
//									   screenRect.origin.y + screenRect.size.height - pickerSize.height,
//									   pickerSize.width,
//									   pickerSize.height);
//		// start the slide up animation
//		[UIView beginAnimations:nil context:NULL];
//        [UIView setAnimationDuration:0.3];
//		
//        // we need to perform some post operations after the animation is complete
//        [UIView setAnimationDelegate:self];
//		
//        datePicker.frame = pickerRect;
//		
//        // shrink the table vertical size to make room for the date picker
//        CGRect newFrame = self.tableView.frame;
//        newFrame.size.height -= self.datePicker.frame.size.height-350;
//        NSLog(@"newFrame.size.height = %f", newFrame.size.height);
//        self.tableView.frame = newFrame;
//		[UIView commitAnimations];
//    }


    [self showPickerView:indexPath.row];
}

- (void)showPickerView:(NSInteger)row {

    switch(row){
        case 2:
            row = 0;
            break;
        case 6:
            row = 1;
            break;
        default:
            break;
    }
    
//    if (self.pickerView == nil){
//        
//        self.pickerView = [[UIPickerView alloc] init];
//        self.pickerView.delegate   = self;
//        self.pickerView.dataSource = self;
        self.pickerView.tag = row;
        
        [self.navigationController.view.window addSubview: self.pickerView];
		
		// size up the picker view to our screen and compute the start/end frame origin for our slide up animation
		//
		// compute the start frame
		CGRect screenRect = [[UIScreen mainScreen] applicationFrame];
		CGSize pickerSize = [self.pickerView sizeThatFits:CGSizeZero];
		CGRect startRect = CGRectMake(0.0,
									  screenRect.origin.y + screenRect.size.height,
									  pickerSize.width, pickerSize.height);
		self.pickerView.frame = startRect;
		
		// compute the end frame
		CGRect pickerRect = CGRectMake(0.0,
									   screenRect.origin.y + screenRect.size.height - pickerSize.height,
									   pickerSize.width,
									   pickerSize.height);
		// start the slide up animation
		[UIView beginAnimations:nil context:NULL];
        [UIView setAnimationDuration:0.3];
		
        // we need to perform some post operations after the animation is complete
        [UIView setAnimationDelegate:self];
		
        self.pickerView.frame = pickerRect;
		
        // shrink the table vertical size to make room for the date picker
        CGRect newFrame = self.tableView.frame;
        newFrame.size.height -= self.pickerView.frame.size.height-350;
        NSLog(@"self.gameStylePickerView.newFrame.size.height = %f", newFrame.size.height);
        self.tableView.frame = newFrame;
		[UIView commitAnimations];
//    }else{
//        
//        self.pickerView.tag = row;
//        [self.pickerView reloadAllComponents];
//    }
}


-(void)textFieldDidReturnWithIndexPath:(NSIndexPath*)indexPath {
    
    //	if(indexPath.row < [labels count]-1) {
    //		
    //        NSIndexPath *path = [NSIndexPath indexPathForRow:indexPath.row+1 inSection:indexPath.section];
    //		[[(ELCTextfieldCell*)[self.tableView cellForRowAtIndexPath:path] rightTextField] becomeFirstResponder];
    //		[self.tableView scrollToRowAtIndexPath:path atScrollPosition:UITableViewScrollPositionTop animated:YES];
    //	}
    //	
    //	else {
    
    [[(ELCTextfieldCell*)[self.tableView cellForRowAtIndexPath:indexPath] rightTextField] resignFirstResponder];
    //	}
}



- (NSInteger)numberOfComponentsInPickerView:(UIPickerView *)pickerView;
{

    return 1;
}

- (void)pickerView:(UIPickerView *)pickerView didSelectRow:(NSInteger)row inComponent:(NSInteger)component
{
    
    
}

- (NSInteger)pickerView:(UIPickerView *)pickerView numberOfRowsInComponent:(NSInteger)component;
{
    return [[pickerOptionList objectAtIndex:pickerView.tag] count];
}

- (NSString *)pickerView:(UIPickerView *)pickerView titleForRow:(NSInteger)row forComponent:(NSInteger)component;
{
    
    return [[pickerOptionList objectAtIndex:pickerView.tag] objectAtIndex:row];
}

















-(BOOL)textFieldShouldReturn:(UITextField *) theTextField {
    
    [theTextField resignFirstResponder];
        
    return YES;
}

























- (void)dealloc {
    
    [ranking release];
    [datePicker release];
    [pickerView release];
    [super dealloc];
}

@end
